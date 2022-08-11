<?php

namespace Database\Seeders;

use App\Models\Resource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Default users
 *
 * @author Mariusz Waloszczyk
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Mariusz Waloszczyk
     */
    public function run(): void
    {
        $roleRoles = Role::find(Role::ROLE_ROLES_OVERALL);
        $roleUsers = Role::find(Role::ROLE_USERS_OVERALL);

        $roleRoles->resources()->attach(
            Resource::RES_ROLES_OVERALL,
            [
                'actions' => json_encode([
                    Resource::ACTION_VIEW_ANY,
                    Resource::ACTION_CREATE,
                    Resource::ACTION_DELETE,
                    Resource::ACTION_UPDATE,
                    Resource::ACTION_VIEW,
                ]),
            ]
        );

        $roleUsers->resources()->attach(
            Resource::RES_USERS_OVERALL,
            [
                'actions' => json_encode([
                    Resource::ACTION_VIEW_ANY,
                    Resource::ACTION_CREATE,
                    Resource::ACTION_DELETE,
                    Resource::ACTION_UPDATE,
                    Resource::ACTION_VIEW,
                ]),
            ]
        );

        User::factory()
            ->hasAttached($roleRoles)
            ->hasAttached($roleUsers)
            ->create([
                'name' => 'Administrator',
                'surname' => 'Administrator',
                'email' => 'admin@admin.admin',
                'password' => Hash::make('qwerty'),
            ]);
    }
}
