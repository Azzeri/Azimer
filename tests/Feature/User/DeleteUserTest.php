<?php

namespace Tests\Feature\User;

use App\Models\AclResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    // /**
    //  * Case: Permitted user and correct data
    //  * Expect: User created
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_can_permitted_user_delete_user(): void
    // {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => AclResource::RES_OVERALL_USERS,
    //             'actions' => [
    //                 AclResource::ACTION_DELETE,
    //             ],
    //         ],
    //     ]);

    //     $this->actingAs($auth);

    //     $user = User::factory()->create();

    //     // Act
    //     $response = $this->delete(route('users.destroy', $user->id));

    //     // Assert
    //     $this->assertModelMissing($user);
    //     $response->assertRedirect(route('users.index'));
    // }
}
