<?php

namespace App\Services;

use App\Models\AclResource;
use App\Models\AclRole;

/**
 * Class for acl roles and resources operations
 *
 * @author Mariusz Waloszczyk
 */
class AclService
{
    /**
     * attach the resource to the role with given action
     * @author Mariusz Waloszczyk
     */
    public function attachResourceToRole(
        AclRole $role,
        string $resourceSuffix,
        string $action
    ): void {
        $role->resources()->attach($resourceSuffix, ['action' => $action]);
    }
}
