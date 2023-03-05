<?php

namespace Tests\Feature;

use App\Models\AclResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class AclRoleIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Case: Correct data
     * Expected: Role updated
     *
     * @author Mariusz Waloszczyk
     */
    public function test_index_success(): void
    {
        // Arrange
        $auth = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_VIEW_ANY
        );
        $this->actingAs($auth);

        // Act
        $response = $this->get(route('aclRoles.index'));

        // Assert
        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('AclRole/Index')
        );
    }
}
