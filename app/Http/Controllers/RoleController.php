<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Resource;
use App\Models\Role;
use App\Services\DropdownService;
use App\Services\RoleService;

/**
 * @author Mariusz Waloszczyk
 */
class RoleController extends Controller
{
    public function __construct(
        public RoleService $roleService,
        public DropdownService $dropdownService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(Resource::ACTION_VIEW_ANY, Role::class);

        return inertia('Roles', [
            'roles' => $this->roleService->getRolesCollection(),
            'resources' => $this->dropdownService->getResourcesDropdown(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Http\Response
     */
    public function store(
        StoreRoleRequest $request,
    ) {
        $this->roleService->storeRole($request);

        return redirect()->route('roles.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdateRoleRequest $request,
        Role $role
    ) {
        $this->roleService->updateRole(
            $request,
            $role
        );

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize(
            Resource::ACTION_DELETE,
            $role,
            Role::class
        );

        $this->roleService->destroyRole($role);

        return redirect()->route('roles.index');
    }
}
