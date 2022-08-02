<?php

namespace Tests;

use App\Models\Resource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * @author Mariusz Waloszczyk
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

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
        array $resources,
    ): User {
        $role = Role::factory()->create();

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

        return User::factory()
            ->hasAttached($role)
            ->create();
    }
}
