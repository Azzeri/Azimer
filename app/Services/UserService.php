<?php

namespace App\Services;

use App\Helpers\DataTableRow;
use App\Http\Resources\DateTableRowResource;
use App\Http\Resources\UserResource;
use App\Mail\WelcomeEmail;
use App\Models\AclResource;
use App\Models\AclRole;
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
     * Returns users list for index
     *
     * @author Mariusz Waloszczyk
     */
    public function getUsersQuery()
    {
        $dataTableService = new DataTableService(
            [
                new DataTableRow('id', 'ID', searchable: false),
                new DataTableRow('name', 'name'),
                new DataTableRow('surname', 'surname'),
                new DataTableRow('email', 'email'),
                new DataTableRow('fire_brigade_unit_id', 'Fire Brigade Unit', searchable: false),
                new DataTableRow('actions', 'actions', searchable: false, sortable: false),
            ]
        );

        $query = $dataTableService->prepareQuery(
            User::class,
            [
                'fireBrigadeUnit',
            ],
        );

        $query = $dataTableService->getResults($query);

        return UserResource::collection($query)
            ->additional([
                'columns' => DateTableRowResource::collection(
                    $dataTableService->getFields()
                ),
            ]);
    }

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
                AclRole::findOrFail($role['suffix']),
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
            AclResource::RES_OVERALL_USERS
        ) > 1 && $this->getUsersWithFullResourceControl(
            AclResource::RES_OVERALL_USERS
        ) > 1 && $this->getUsersWithFullResourceControl(
            AclResource::RES_OVERALL_FIRE_BRIGADE_UNITS
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
        $possibleActions = AclResource::getPossibleActions();

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

    /**
     * Returns random user or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomUser(): User
    {
        $user = User::inRandomOrder()->first();

        if (is_null($user)) {
            return User::factory()
                ->create();
        }

        return $user;
    }

    /**
     * Returns super admin user
     *
     * @author Mariusz Waloszczyk
     */
    public static function getSuperAdmin(): User
    {
        return User::find(User::SUPER_USER_ID)->first();
    }
}
