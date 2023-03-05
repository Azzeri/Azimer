<?php

namespace Tests\Feature\User;

use App\Models\AclResource;
use App\Models\FireBrigadeUnit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    // /**
    //  * Indicates whether the default seeder should run before each test.
    //  *
    //  * @var bool
    //  */
    // protected $seed = true;

    // /**
    //  * Case: Permitted user and correct data
    //  * Expect: User created
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_can_permitted_user_update_user(): void
    // {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => AclResource::RES_OVERALL_USERS,
    //             'actions' => [
    //                 AclResource::ACTION_UPDATE,
    //             ],
    //         ],
    //     ]);

    //     $this->actingAs($auth);

    //     $fireBrigadeUnit =
    //         FireBrigadeUnit::factory()->create();

    //     $oldData = [
    //         'name' => 'testName',
    //         'surname' => 'testSurname',
    //         'email' => 'testemail@gmail.com',
    //         'phone' => '123456789',
    //     ];

    //     $newData = [
    //         'name' => 'updatedName',
    //         'surname' => 'updatedSurname',
    //         'email' => 'updatedemail@gmail.com',
    //         'phone' => '1123456789',
    //         'phone' => '1123456789',
    //         'fire_brigade_unit_id' => $fireBrigadeUnit->id,
    //     ];

    //     $user = User::factory()
    //         ->hasAttached(
    //             Role::create(
    //                 [
    //                     'suffix' => 'role_to_delete',
    //                     'name' => 'role to delete',
    //                 ],
    //             )
    //         )
    //         ->create($oldData);

    //     $request = [
    //         'name' => $newData['name'],
    //         'surname' => $newData['surname'],
    //         'email' => $newData['email'],
    //         'phone' => $newData['phone'],
    //         'fire_brigade_unit_id' => $newData['fire_brigade_unit_id'],
    //         'roles' => [
    //             [
    //                 'suffix' => Role::ROLE_ROLES_OVERALL,
    //             ],
    //             [
    //                 'suffix' => Role::ROLE_USERS_OVERALL,
    //             ],
    //         ],
    //     ];

    //     // Act
    //     $response = $this->put(
    //         route('users.update', $user->id),
    //         $request
    //     );

    //     // Assert
    //     $this->assertDatabaseHas('users', $newData);
    //     $response->assertRedirect(route('users.index'));
    // }
}
