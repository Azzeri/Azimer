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
class AclRoleDeleteTest extends TestCase
{
    use RefreshDatabase;

    private User $userWithPermission;

    private AclRole $roleToDelete;

    public function setUp(): void
    {
        parent::setUp();

        $this->roleToDelete = AclRole::factory()->create();

        $this->userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_DELETE
        );
    }

    /**
     * Case: given unused role to delete
     * Expected: Role deleted
     *
     * @author Mariusz Waloszczyk
     */
    public function test_delete_role_success(): void
    {
        // Arrange
        $this->actingAs($this->userWithPermission);

        // Act
        $this->delete(route('aclRoles.destroy', $this->roleToDelete));

        // Assert
        $this->assertModelMissing($this->roleToDelete);
    }

    /**
     * Case: User without permission
     * Expected: role not deleted
     *
     * @author Mariusz Waloszczyk
     */
    public function test_user_without_permission_can_not_delete_role(): void
    {
        // Arrange
        $this->authenticateAsUserWithoutPermissions();

        // Act
        $response = $this->delete(route('aclRoles.destroy', $this->roleToDelete));

        // Assert
        $response->assertForbidden();
        $this->assertModelExists($this->roleToDelete);
    }

    /**
     * Case: Superadmin role should not be possible to delete
     * Expected: Role not deleted
     *
     * @author Mariusz Waloszczyk
     */
    public function test_superadmin_can_not_be_deleted(): void
    {
        // Arrange
        $this->actingAs($this->userWithPermission);
        $superAdminRole = AclRole::superAdmin()->first();

        // Act
        $response = $this->delete(route('aclRoles.destroy', $superAdminRole));

        // Assert
        $response->assertForbidden();
        $this->assertModelExists($superAdminRole);
    }
}
