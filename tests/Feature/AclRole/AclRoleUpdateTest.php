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
            'aclResources' => [
                [
                    'suffix' => AclResource::RES_LOWLY_UNITS_EQUIPMENT,
                    'action' => AclResource::ACTION_DELETE,
                ],
                [
                    'suffix' => AclResource::RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT,
                    'action' => AclResource::ACTION_CREATE,
                ],
            ],
        ];
        $this->roleToUpdate = AclRole::factory()->create();
        $this->roleToUpdate->resources()->attach(
            AclResource::RES_LOWLY_UNITS_EQUIPMENT,
            ['action' => AclResource::ACTION_DELETE]
        );
        $this->roleToUpdate->resources()->attach(
            AclResource::RES_DUMMY,
            ['action' => AclResource::ACTION_DELETE]
        );
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
        $user = User::factory()->create();
        $user->roles()->attach($this->roleToUpdate);

        // Act
        $response = $this->put(
            route('aclRoles.update', $this->roleToUpdate),
            $this->correctForm
        );

        // Assert
        $this->roleToUpdate = AclRole::find($this->correctForm['suffix']);
        $response->assertValid();
        $this->assertDatabaseHas('acl_roles', [
            'suffix' => $this->correctForm['suffix'],
        ]);
        $this->assertEquals(
            AclResource::RES_LOWLY_UNITS_EQUIPMENT,
            $this->roleToUpdate->resources[0]->suffix
        );
        $this->assertEquals(
            AclResource::ACTION_DELETE,
            $this->roleToUpdate->resources[0]->pivot->action
        );
        $this->assertEquals(
            AclResource::RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT,
            $this->roleToUpdate->resources[1]->suffix
        );
        $this->assertEquals(
            AclResource::ACTION_CREATE,
            $this->roleToUpdate->resources[1]->pivot->action
        );
        $this->assertEquals(2, $this->roleToUpdate->resources->count());
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
        $superAdminRole = AclRole::superAdmin()->first();

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
