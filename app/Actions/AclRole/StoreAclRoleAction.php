<?php

namespace App\Actions\AclRole;

use App\Models\AclRole;
use Illuminate\Http\Request;

/**
 * @author Mariusz Waloszczyk
 */
class StoreAclRoleAction
{
    /**
     * Stores item in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request
    ): AclRole {
        $role = AclRole::create([
            'suffix' => $request->suffix,
        ]);

        if ($request->aclResources) {
            $role->resources()->attach($request->aclResources);
        }

        return $role;
    }
}
