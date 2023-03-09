<?php

namespace Tests;

use App\Models\AclResource;
use App\Models\AclRole;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * @author Mariusz Waloszczyk
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Creates a new user with role having given resources with actions
     *
     * @author Mariusz Waloszczyk
     */
    protected function getUserWithResourcesAndActions(
        array $resourcesWithActions,
    ): User {
        $role = AclRole::factory()->create();
        foreach ($resourcesWithActions as $data) {
            $resource = AclResource::findOrFail($data['suffix']);
            $role->resources()->attach(
                $resource->suffix, ['action' => $data['action']]
            );
        }

        return User::factory()
            ->hasAttached(factory: $role, relationship: 'roles')
            ->create();
    }

    /**
     * Creates a new user with role having the given resource with the given action
     *
     * @author Mariusz Waloszczyk
     */
    protected function getUserWithOneResourceAndAction(
        string $resourceSuffix,
        string $action
    ): User {
        return $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resourceSuffix,
                'action' => $action,
            ],
        ]);
    }

    /**
     * Authenticates as super admin
     *
     * @author Mariusz Waloszczyk
     */
    protected function authenticateAsSuperAdmin(): void
    {
        $admin = User::superAdmin()->first();

        $this->actingAs($admin);
    }

    /**
     * Authenticates as user who doesn't have any resources
     *
     * @author Mariusz Waloszczyk
     */
    protected function authenticateAsUserWithoutPermissions(): void
    {
        $auth = User::factory()->create();

        $this->actingAs($auth);
    }
}
