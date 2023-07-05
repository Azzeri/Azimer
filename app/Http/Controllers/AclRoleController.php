<?php

namespace App\Http\Controllers;

use App\Actions\AclRole\DeleteAclRoleAction;
use App\Actions\AclRole\StoreAclRoleAction;
use App\Actions\AclRole\UpdateAclRoleAction;
use App\Http\Requests\AclRole\AclRoleRequest;
use App\Models\AclResource;
use App\Models\AclRole;
use App\Services\AclService;
use App\Services\DropdownService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;

/**
 * @author Mariusz Waloszczyk
 */
class AclRoleController extends Controller
{
    public function __construct(
        public AclService $aclService,
        public DropdownService $dropdownService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @author Mariusz Waloszczyk
     */
    public function index(
        AclRoleRequest $aclRoleRequest,
    ): InertiaResponse {
        $aclData = [
            'aclRoles' => $this->aclService->getAclRolesCollection(),
            'aclResources' => $this->aclService->getAclResourcesCollection(),
            'aclActions' => AclResource::getPossibleActions(),
        ];

        return inertia(
            'AclRole/AclRolesIndex',
            ['aclData' => $aclData]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function store(
        AclRoleRequest $aclRoleRequest,
        StoreAclRoleAction $storeAclRoleAction
    ): RedirectResponse {
        $storeAclRoleAction->execute($aclRoleRequest);

        return redirect()->route('aclRoles.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function update(
        AclRoleRequest $aclRoleRequest,
        AclRole $aclRole,
        UpdateAclRoleAction $updateAclRoleAction
    ): RedirectResponse {
        $updateAclRoleAction->execute($aclRoleRequest, $aclRole);

        return redirect()->route('aclRoles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function destroy(
        AclRoleRequest $aclRoleRequest,
        AclRole $aclRole,
        DeleteAclRoleAction $deleteAclRoleAction
    ): RedirectResponse {
        $deleteAclRoleAction->execute($aclRole);

        return redirect()->route('aclRoles.index');
    }
}
