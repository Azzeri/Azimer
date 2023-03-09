<?php

namespace App\Actions\AclRole;

use App\Models\AclRole;
use App\Services\AclService;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteAclRoleAction
{
    /**
     * @author Mariusz Waloszczyk
     */
    public function __construct(
        private AclService $aclService,
    ) {
    }

    /**
     * Deletes role from db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        AclRole $aclRole
    ): bool|null {
        $this->aclService->detachRoleFromAllUsers($aclRole);

        return $aclRole->delete();
    }
}
