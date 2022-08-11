<?php

namespace Database\Seeders;

use App\Models\Resource;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Default roles and resources
 *
 * @author Mariusz Waloszczyk
 */
class RoleResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Mariusz Waloszczyk
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'suffix' => Role::ROLE_ROLES_OVERALL,
                'name' => 'Overall roles manager',
            ],
        ]);

        DB::table('resources')->insert([
            [
                'suffix' => Resource::RES_ROLES_OVERALL,
                'name' => 'Overall roles management',
            ],
        ]);

        DB::table('resources')->insert([
            [
                'suffix' => Resource::RES_VEHICLES_OVERALL,
                'name' => 'Overall vehicles management',
            ],
        ]);
    }
}
