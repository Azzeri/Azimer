<?php

namespace App\Services;

use App\Mail\WelcomeEmail;
use App\Models\Resource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class for roles operations
 *
 * @author Mariusz Waloszczyk
 */
class UserService
{
    /**
     * Detaches all roles and
     * attaches new roles to the user
     *
     * @author Mariusz Waloszczyk
     */
    public function attachRoles(
        User $user,
        array $roles
    ): void {
        $user->roles()->detach();

        foreach ($roles as $role) {
            $user->roles()->attach(
                Role::findOrFail($role['suffix']),
            );
        }
    }

    /**
     * Generates random password and hashes it
     *
     * @author Mariusz Waloszczyk
     */
    public function generateRandomPassword(): string
    {
        return Hash::make(
            substr(
                str_shuffle(
                    '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'
                ),
                0,
                16
            )
        );
    }

    /**
     * Sends welcome email with with random password
     *
     * @author Mariusz Waloszczyk
     */
    public function sendWelcomeEmail(
        string $email,
        string $password
    ): void {
        Mail::to($email)->send(new WelcomeEmail(
            $email,
            $password
        ));
    }

    /**
     * Checks if all conditions
     * for deleting users are met
     *
     * @author Mariusz Waloszczyk
     */
    public function canUserBeDeleted(): bool
    {
        return $this->getUsersWithFullResourceControl(
            Resource::RES_ROLES_OVERALL
        ) > 1 && $this->getUsersWithFullResourceControl(
            Resource::RES_USERS_OVERALL
        ) > 1 && $this->getUsersWithFullResourceControl(
            Resource::RES_FIRE_BRIGADE_UNITS_OVERALL
        ) > 1;
    }

    /**
     * Checks how many users have roles resource
     * with all actions
     *
     * @return Illuminate\Support\Collection
     *
     * @author Mariusz Waloszczyk
     */
    public function getUsersWithFullResourceControl(
        string $resource
    ) {
        $users = User::all();
        $collectedUsers = collect();
        $possibleActions = Resource::getPossibleActions();

        foreach ($users as $user) {
            $actionsCounter = 0;
            foreach ($possibleActions as $action) {
                if (
                    $user->hasResourceWithAction(
                        $resource,
                        $action
                    )
                ) {
                    $actionsCounter++;
                }
            }

            if ($actionsCounter == count($possibleActions)) {
                $collectedUsers->add($user);
            }

            $actionsCounter = 0;
        }

        return $collectedUsers;
    }
}
