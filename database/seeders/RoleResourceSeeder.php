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
                'suffix' => Resource::RES_MANUFACTURERS_OVERALL,
                'name' => 'Overall manufacturers management',
            ],
        ]);
        
        DB::table('roles')->insert([
            [
                'suffix' => Role::ROLE_USERS_OVERALL,
                'name' => 'Overall users manager',
            ],
        ]);

        DB::table('resources')->insert([
            [
                'suffix' => Resource::RES_USERS_OVERALL,
                'name' => 'Overall users management',
            ],
        ]);

        DB::table('resources')->insert([
            [
                'suffix' => Resource::RES_FIRE_BRIGADE_UNIT_OWN,
                'name' => 'Own fire brigade unit management',
            ],
        ]);

        DB::table('resources')->insert([
            [
                'suffix' => Resource::RES_FIRE_BRIGADE_UNITS_LOWLY,
                'name' => 'Lowly fire brigade units management',
            ],
        ]);

        DB::table('resources')->insert([
            [
                'suffix' => Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
                'name' => 'Overall fire brigade units management',
            ],
        ]);

        DB::table('resources')->insert([
            [
                'suffix' => Resource::RES_USERS_OWN_UNIT,
                'name' => 'Users in own unit management',
            ],
        ]);

        DB::table('resources')->insert([
            [
                'suffix' => Resource::RES_USERS_LOWLY_UNITS,
                'name' => 'Users in lowly units management',
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
