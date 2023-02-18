<?php

namespace Tests;

use App\Models\AclResource;
use App\Models\AclRole;
use App\Models\User;
use App\Services\AclService;
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
     * Creates a new user with role having
     * given resources with actions
     * and authorizes as him
     *
     * @param  array<string>  $resources
     *
     * @author Mariusz Waloszczyk
     */
    protected function getUserWithResourcesAndActions(
        array $resourcesWithActions,
    ): User {
        $aclService = new AclService();
        $role = AclRole::factory()->create();

        foreach ($resourcesWithActions as $data) {
            $resource = AclResource::findOrFail($data['suffix']);
            foreach ($data['actions'] as $action) {
                $aclService->attachResourceToRole(
                    $role,
                    $resource->suffix,
                    $action,
                );
            }
        }

        return User::factory()
            ->hasAttached($role, [], 'roles')
            ->create();
    }
}
