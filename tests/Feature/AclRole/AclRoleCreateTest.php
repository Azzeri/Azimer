<?php

namespace Tests\Feature;

use App\Models\AclResource;
use App\Models\AclRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class AclRoleCreateTest extends TestCase
{
    use RefreshDatabase;

    private User $userWithPermission;

    private array $correctForm;

    public function setUp(): void
    {
        parent::setUp();

        $this->correctForm = [
            'suffix' => 'role_example',
            'aclResources' => [
                AclResource::RES_LOWLY_UNITS_USERS => [
                    'action' => AclResource::ACTION_VIEW,
                ],
                AclResource::RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT => [
                    'action' => AclResource::ACTION_CREATE,
                ],
            ],
        ];
        $this->userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_CREATE
        );
    }

    /**
     * Case: Correct data
     * Expected: Role created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_role_success(): void
    {
        // Arrange
        $this->actingAs($this->userWithPermission);

        // Act
        $response = $this->post(route('aclRoles.store'), $this->correctForm);

        // Assert
        $createdRole = AclRole::find($this->correctForm['suffix']);
        $response->assertValid();
        $this->assertDatabaseHas('acl_roles', [
            'suffix' => $this->correctForm['suffix'],
        ]);
        $this->assertEquals(2, $createdRole->resources->count());
    }

    /**
     * Case: User without permission
     * Expected: Role not created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_user_without_permission_can_not_store_role(): void
    {
        // Arrange
        $this->authenticateAsUserWithoutPermissions();

        // Act
        $response = $this->post(route('aclRoles.store'), $this->correctForm);

        // Assert
        $response->assertForbidden();
        $this->assertDatabaseMissing('acl_roles', $this->correctForm);
    }
}
