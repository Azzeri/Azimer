<?php

namespace App\Actions\AclRole;

use App\Models\AclRole;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteAclRoleAction
{
    /**
     * Deletes role from db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        AclRole $aclRole
    ): bool|null {
        return $aclRole->delete();
    }
}
