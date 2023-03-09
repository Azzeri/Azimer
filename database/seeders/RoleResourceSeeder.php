<?php

namespace Database\Seeders;

use App\Models\AclResource;
use App\Models\AclRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $this->createDefaultResources();
        $this->createSuperAdmin();
    }

    /**
     * Creates default resources
     *
     * @author Mariusz Waloszczyk
     */
    private function createDefaultResources(): void
    {
        $resources = [
            AclResource::RES_DUMMY,
            AclResource::RES_OVERALL_USERS,
            AclResource::RES_OVERALL_FIRE_BRIGADE_UNITS,
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::RES_OVERALL_EQUIPMENT,
            AclResource::RES_OWN_UNIT_USERS,
            AclResource::RES_OWN_UNIT_FIRE_BRIGADE_UNIT,
            AclResource::RES_OWN_UNIT_EQUIPMENT,
            AclResource::RES_LOWLY_UNITS_USERS,
            AclResource::RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT,
            AclResource::RES_LOWLY_UNITS_EQUIPMENT,
        ];

        foreach ($resources as $resourceName) {
            AclResource::create([
                'suffix' => $resourceName,
            ]);
        }
    }

    /**
     * creates super admin role and assigns him overall resources with every action
     *
     * @author Mariusz Waloszczyk
     */
    private function createSuperAdmin(): void
    {
        $adminResources = [
            AclResource::RES_OVERALL_USERS,
            AclResource::RES_OVERALL_FIRE_BRIGADE_UNITS,
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::RES_OVERALL_EQUIPMENT,
        ];

        $superAdminRole = AclRole::create([
            'suffix' => AclRole::ROLE_SUPER_ADMIN,
        ]);

        $aclActions = AclResource::getPossibleActions();
        foreach ($adminResources as $resourceSuffix) {
            foreach ($aclActions as $action) {
                $superAdminRole
                    ->resources()
                    ->attach($resourceSuffix, ['action' => $action]);
            }
        }

        $superAdminUser = User::create([
            'name' => 'Super',
            'surname' => 'Administrator',
            'email' => 'admin@admin.admin',
            'password' => Hash::make('qwerty'),
        ]);
        $superAdminUser->roles()->attach($superAdminRole);
    }
}
