<?php

namespace App\Services;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Mail\WelcomeEmail;
use App\Models\Resource;
use App\Models\Role;
use App\Models\User;
use Exception;
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
     * Stores user in the database
     *
     * @author Mariusz Waloszczyk
     */
    public function storeUser(
        StoreUserRequest $request,
        string $password
    ): User {
        return User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($password),
            'fire_brigade_unit_id' => $request->fire_brigade_unit_id,
        ]);
    }

    /**
     * Updates given user
     *
     * @author Mariusz Waloszczyk
     */
    public function updateUser(
        UpdateUserRequest $request,
        User $user
    ): bool {
        $userRoles = $user->roles();
        $user->roles()->detach();

        try {
            $this->attachRoles($user, $request->roles);
        } catch (Exception $e) {
            $user->roles()->detach();
            $user->roles()->attach($userRoles);
        }

        return $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'fire_brigade_unit_id' => $request->fire_brigade_unit_id,
        ]);
    }

    /**
     * Soft deletes user from storage
     *
     * @author Mariusz Waloszczyk
     */
    public function destroyUser(User $user): bool|null
    {
        if (! $this->canUserBeDeleted($user)) {
            return false;
        }

        return $user->delete();
    }

    /**
     * Detaches all roles and
     * attaches new roles to the user
     *
     * @author Mariusz Waloszczyk
     */
    private function attachRoles(
        User $user,
        array $roles
    ): void {
        $user->roles()->detach();

        foreach ($roles as $role) {
            $user->roles()->attach(
                Role::find($role['suffix']),
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
    private function canUserBeDeleted(): bool
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
