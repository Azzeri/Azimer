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
        $role = Role::find(Role::ROLE_ROLES_OVERALL);

        $role->resources()->attach(
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

        User::factory()
            ->hasAttached($role)
            ->create([
                'name' => 'Administrator',
                'email' => 'admin@admin.admin',
                'password' => Hash::make('qwerty'),
            ]);
    }
}
