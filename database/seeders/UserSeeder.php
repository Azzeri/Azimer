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
        $role = Role::create([
            'suffix' => 'role_overall',
            'name' => 'One to rule them all',
        ]);

        $role->resources()->attach(
            Resource::RES_ROLES_OVERALL,
            [
                'actions' => json_encode(
                    Resource::getPossibleActions(),
                ),
            ]
        );

        $role->resources()->attach(
            Resource::RES_USERS_OVERALL,
            [
                'actions' => json_encode(
                    Resource::getPossibleActions(),
                ),
            ]
        );

        User::factory()
            ->hasAttached($role)
            ->create([
                'name' => 'Administrator',
                'surname' => 'Administrator',
                'email' => 'admin@admin.admin',
                'password' => Hash::make('qwerty'),
            ]);
    }
}
