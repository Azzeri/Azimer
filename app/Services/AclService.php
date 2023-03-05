<?php

namespace App\Services;

use App\Http\Resources\AclRoleResource;
use App\Models\AclRole;

/**
 * Class for acl roles and resources operations
 *
 * @author Mariusz Waloszczyk
 */
class AclService
{
    /**
     * Returns all roles from database
     * with optional pagination
     *
     * @return mixed
     *
     * @author Mariusz Waloszczyk
     */
    public function getAclRolesCollection()
    {
        $query = AclRole::with('resources')->get();

        return AclRoleResource::collection($query);
    }

    /**
     * returns superadmin role
     *
     * @author Mariusz Waloszczyk
     */
    public static function getSuperAdminRole(): AclRole
    {
        return AclRole::find(AclRole::ROLE_SUPER_ADMIN);
    }
}
