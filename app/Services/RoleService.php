<?php

namespace App\Services;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Resource;
use App\Models\Role;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class for roles operations
 *
 * @author Mariusz Waloszczyk
 */
class RoleService
{
    /**
     * Returns all roles from database
     * with optional pagination
     *
     * @author Mariusz Waloszczyk
     */
    public function getRolesCollection(
        ?int $paginationSize = null
    ): AnonymousResourceCollection {
        return is_null($paginationSize)
            ? RoleResource::collection(Role::all())
            : RoleResource::collection(Role::paginate($paginationSize));
    }

    /**
     * Stores role in the database
     *
     * @author Mariusz Waloszczyk
     */
    public function storeRole(StoreRoleRequest $request): Role
    {
        return Role::create([
            'suffix' => $request->suffix,
            'name' => $request->name,
        ]);
    }

    /**
     * Updates given model
     *
     * @throws Exception
     *
     * @author Mariusz Waloszczyk
     */
    public function updateRole(
        UpdateRoleRequest $request,
        Role $role
    ): bool {
        $roleResources = $role->resources;

        try {
            $this->attachResources($role, $request->resources);
        } catch (Exception $e) {
            $role->resources()->detach();
            $role->resources()->attach($roleResources);
        }

        return $role->update([
            'suffix' => $request->newSuffix,
            'name' => $request->name,
        ]);
    }

    /**
     * Removes the role from storage
     * also detaches all relations
     *
     * @author Mariusz Waloszczyk
     */
    public function destroyRole(Role $role): bool|null
    {
        return $role->delete();
    }

    /**
     * Detaches all resources and
     * attaches new resources to the role
     *
     * @author Mariusz Waloszczyk
     */
    private function attachResources(
        Role $role,
        array $resources
    ): void {
        $role->resources()->detach();

        foreach ($resources as $resource) {
            $role->resources()->attach(
                Resource::find($resource['suffix']),
                [
                    'actions' => json_encode(
                        $resource['actions']
                    ),
                ]
            );
        }
    }
}
