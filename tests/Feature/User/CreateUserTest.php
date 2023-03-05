<?php

namespace Tests\Feature\User;

use App\Models\AclResource;
use App\Models\FireBrigadeUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Case: Permitted user and correct data
     * Expect: User created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_can_permitted_user_store_user_correct_data(): void
    {
        // Arrange
        $userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_CREATE
        );
        $this->actingAs($userWithPermission);

        $fireBrigadeUnit =
            FireBrigadeUnit::factory()->create();

        $params = [
            'name' => 'Test',
            'surname' => 'Test',
            'email' => 'test@gmail.com',
            'phone' => '123456789',
            'fire_brigade_unit_id' => $fireBrigadeUnit->id,
        ];

        // Act
        $response = $this->post(route('users.store'), $params);

        // Assert
        $response->assertValid();
        // $this->assertDatabaseHas('users', $params);
        // $response->assertRedirect(route('users.index'));
    }
}
