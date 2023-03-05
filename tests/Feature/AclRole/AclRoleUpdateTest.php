<?php

namespace Tests\Feature;

use App\Models\AclResource;
use App\Models\AclRole;
use App\Models\User;
use App\Services\AclService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class AclRoleUpdateTest extends TestCase
{
    use RefreshDatabase;

    private User $userWithPermission;

    private array $correctForm;

    private AclRole $roleToUpdate;

    public function setUp(): void
    {
        parent::setUp();

        $this->correctForm = [
            'suffix' => 'role_updated',
        ];
        $this->roleToUpdate = AclRole::factory()->create();
        $this->userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_UPDATE
        );
    }

    /**
     * Case: Correct data
     * Expected: Role updated
     *
     * @author Mariusz Waloszczyk
     */
    public function test_update_role_success(): void
    {
        // Arrange
        $this->actingAs($this->userWithPermission);

        // Act
        $response = $this->put(
            route('aclRoles.update', $this->roleToUpdate),
            $this->correctForm
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('acl_roles', $this->correctForm);
    }

    /**
     * Case: User without permission
     * Expected: Role not updated
     *
     * @author Mariusz Waloszczyk
     */
    public function test_user_without_user_can_not_update_role(): void
    {
        // Arrange
        $this->authenticateAsUserWithoutPermissions();

        // Act
        $response = $this->put(
            route('aclRoles.update', $this->roleToUpdate),
            $this->correctForm
        );

        // Assert
        $response->assertForbidden();
        $this->assertDatabaseMissing('acl_roles', $this->correctForm);
    }

    /**
     * Case: Superadmin role should not be possible to edit
     * Expected: Role not updated
     *
     * @author Mariusz Waloszczyk
     */
    public function test_superadmin_can_not_be_updated(): void
    {
        // Arrange
        $this->actingAs($this->userWithPermission);
        $superAdminRole = AclService::getSuperAdminRole();

        // Act
        $response = $this->put(
            route('aclRoles.update', $superAdminRole),
            $this->correctForm
        );

        // Assert
        $response->assertForbidden();
        $this->assertDatabaseMissing('acl_roles', $this->correctForm);
    }
}
