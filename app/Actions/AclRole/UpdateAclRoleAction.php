<?php

namespace App\Actions\AclRole;

use App\Models\AclRole;
use Illuminate\Http\Request;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateAclRoleAction
{
    /**
     * Updates role in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request,
        AclRole $aclRole,
    ): bool {
        if ($request->aclResources) {
            $aclRole->resources()->sync($request->aclResources);
        }

        return $aclRole->update([
            'suffix' => $request->suffix,
        ]);
    }
}
