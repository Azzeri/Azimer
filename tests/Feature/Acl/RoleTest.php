<?php

namespace Tests\Feature;

use App\Models\AclResource;
use App\Models\AclRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class RoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    // /**
    //  * Case: Permitted user
    //  * Expected: Can see index with data
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_can_authorized_user_view_roles(): void
    // {
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => AclResource::RES_OVERALL_USERS,
    //             'actions' => [
    //                 AclResource::ACTION_VIEW,
    //             ],
    //         ],
    //     ]);

    //     $this->actingAs($auth);

    //     // Act
    //     $response = $this->get(route('roles.index'));

    //     // Assert
    //     $response->assertInertia(fn (Assert $page) => $page
    //         ->component('Roles')
    //         ->has('roles')
    //         ->has('resources')
    //     );
    // }

    // /**
    //  * Case: Non permitted user
    //  * Expected: forbidden
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_can_unauthorized_user_view_roles(): void
    // {
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => AclResource::RES_DUMMY,
    //             'actions' => [
    //                 AclResource::ACTION_VIEW,
    //             ],
    //         ],
    //     ]);

    //     // $this->actingAs($auth);

    //     // // Act
    //     // $response = $this->get(route('roles.index'));

    //     // // Assert
    //     // $response->assertForbidden();
    // }

    // /**
    //  * Case: Permitted user and correct data
    //  * Expect: Role created
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_can_permitted_user_store_role_correct_data(): void
    // {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => AclResource::RES_OVERALL_USERS,
    //             'actions' => [
    //                 AclResource::ACTION_CREATE,
    //             ],
    //         ],
    //     ]);

    //     $this->actingAs($auth);

    //     $params = [
    //         'suffix' => 'role_test_role',
    //         'name' => 'test_role_name',
    //     ];

    //     // Act
    //     $response = $this->post(route('roles.store'), $params);

    //     // Assert
    //     $this->assertDatabaseHas('roles', $params);
    //     $response->assertValid();
    //     $response->assertRedirect(route('roles.index'));
    // }

    // /**
    //  * Case: Permitted user and incorrect data
    //  * Expect: Role not created
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_can_permitted_user_store_role_incorrect_data(): void
    // {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => AclResource::RES_OVERALL_USERS,
    //             'actions' => [
    //                 AclResource::ACTION_CREATE,
    //             ],
    //         ],
    //     ]);

    //     $this->actingAs($auth);

    //     $params = [
    //         'suffix' => 'te',
    //         'name' => 'te',
    //     ];

    //     // Act
    //     $response = $this->post(route('roles.store'), $params);

    //     // Assert
    //     $this->assertDatabaseMissing('roles', $params);
    //     $response->assertInvalid();
    // }

    // /**
    //  * Case: Non-permitted user
    //  * Expect: Role not created
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_can_non_permitted_user_store_role(): void
    // {
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => AclResource::RES_OVERALL_USERS,
    //             'actions' => [
    //                 AclResource::ACTION_VIEW,
    //             ],
    //         ],
    //     ]);

    //     $this->actingAs($auth);

    //     // Act
    //     $response = $this->post(route('roles.store'), []);

    //     // Assert
    //     $response->assertForbidden();
    // }

    // // /**
    // //  * Case: Permitted user and correct data
    // //  * Expect: Role updated
    // //  *
    // //  * @author Mariusz Waloszczyk
    // //  */
    // // public function test_can_permitted_user_update_role_correct_data(): void
    // // {
    // //     // Arrange
    // //     $auth = $this->getUserWithResourcesAndActions([
    // //         [
    // //             'suffix' => AclResource::RES_OVERALL_USERS,
    // //             'actions' => [
    // //                 AclResource::ACTION_UPDATE,
    // //             ],
    // //         ],
    // //     ]);

    // //     $this->actingAs($auth);

    // //     $currentRoleParams = [
    // //         'suffix' => 'role_current_suffix',
    // //         'name' => 'current_name',
    // //     ];

    // //     $updatedRoleParams = [
    // //         'suffix' => 'role_updated_suffix',
    // //         'name' => 'updated_name',
    // //     ];

    // //     $role = Role::factory()
    // //         ->hasAttached(
    // //             Resource::create(
    // //                 [
    // //                     'suffix' => 'res_to_delete',
    // //                     'name' => 'res to delete',
    // //                 ],
    // //             ),
    // //             [
    // //                 'actions' => json_encode(['Create']),
    // //             ]
    // //         )
    // //         ->create($currentRoleParams);

    // //     Resource::create([
    // //         'suffix' => 'res_test',
    // //         'name' => 'res test',
    // //     ]);

    // //     $request = [
    // //         'suffix' => $role->suffix,
    // //         'newSuffix' => $updatedRoleParams['suffix'],
    // //         'name' => $updatedRoleParams['name'],
    // //         'resources' => [
    // //             [
    // //                 'suffix' => AclResource::RES_OVERALL_USERS,
    // //                 'actions' => [
    // //                     AclResource::ACTION_VIEW,
    // //                     AclResource::ACTION_CREATE,
    // //                     AclResource::ACTION_CREATE,
    // //                 ],
    // //             ],
    // //             [
    // //                 'suffix' => 'res_test',
    // //                 'actions' => [
    // //                     AclResource::ACTION_VIEW,
    // //                     AclResource::ACTION_UPDATE,
    // //                     AclResource::ACTION_DELETE,
    // //                 ],
    // //             ],
    // //         ],
    // //     ];

    // //     // Act
    // //     $response = $this->put(
    // //         route('roles.update', $role->suffix),
    // //         $request
    // //     );

    // //     // Assert
    // //     $this->assertDatabaseHas('roles', $updatedRoleParams);
    // //     $this->assertDatabaseMissing('roles', $currentRoleParams);
    // //     // $this->assertTrue($role->resources()->where('suffix', AclResource::RES_OVERALL_USERS)->exists());
    // //     $response->assertValid();
    // //     $response->assertRedirect(route('roles.index'));
    // // }

    // /**
    //  * Case: Non-permitted user
    //  * Expect: Role not updated
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_can_non_permitted_user_update_role(): void
    // {
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => AclResource::RES_OVERALL_USERS,
    //             'actions' => [
    //                 AclResource::ACTION_VIEW,
    //             ],
    //         ],
    //     ]);

    //     $this->actingAs($auth);

    //     $role = Role::factory()->create();

    //     // Act
    //     $response = $this->put(route('roles.update', $role->suffix), []);

    //     // Assert
    //     $response->assertForbidden();
    // }

    // // /**
    // //  * Case: Permitted user
    // //  * Expect: Role deleted and
    // //  * pivot tables records detached
    // //  *
    // //  * @author Mariusz Waloszczyk
    // //  */
    // // public function test_can_permitted_user_delete_role(): void
    // // {
    // //     // Arrange
    // //     $auth = $this->getUserWithResourcesAndActions([
    // //         [
    // //             'suffix' => AclResource::RES_OVERALL_USERS,
    // //             'actions' => [
    // //                 AclResource::ACTION_DELETE,
    // //             ],
    // //         ],
    // //     ]);

    // //     $this->actingAs($auth);

    // //     $role = Role::factory()
    // //         ->hasAttached(
    // //             Resource::create(
    // //                 [
    // //                     'suffix' => 'res',
    // //                     'name' => 'res',
    // //                 ],
    // //             ),
    // //             [
    // //                 'actions' => json_encode(['Create']),
    // //             ]
    // //         )
    // //         ->create();

    // //     User::factory()
    // //         ->hasAttached($role)
    // //         ->create();

    // //     // Act
    // //     $response = $this->delete(route('roles.destroy', $role->suffix));

    // //     // Assert
    // //     $this->assertModelMissing($role);
    // //     $this->assertEmpty($role->resources);
    // //     $this->assertEmpty($role->users);
    // //     $response->assertRedirect(route('roles.index'));
    // // }

    // // /**
    // //  * Case: Non-permitted user
    // //  * Expect: Role not deleted
    // //  *
    // //  * @author Mariusz Waloszczyk
    // //  */
    // // public function test_can_non_permitted_user_delete_role(): void
    // // {
    // //     // Arrange
    // //     $auth = $this->getUserWithResourcesAndActions([
    // //         [
    // //             'suffix' => AclResource::RES_OVERALL_USERS,
    // //             'actions' => [
    // //                 AclResource::ACTION_CREATE,
    // //             ],
    // //         ],
    // //     ]);

    // //     $this->actingAs($auth);

    // //     $role = Role::factory()->create();

    // //     // Act
    // //     $response = $this->delete(
    // //         route(
    // //             'roles.destroy',
    // //             $role->suffix
    // //         )
    // //     );

    // //     // Assert
    // //     $this->assertModelExists($role);
    // //     $response->assertForbidden();
    // // }
}
