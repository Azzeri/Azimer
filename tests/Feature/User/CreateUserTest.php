<?php

namespace Tests\Feature\User;

use App\Models\FireBrigadeUnit;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Case: Permitted user and correct data
     * Expect: User created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_can_permitted_user_store_user_correct_data(): void
    {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_USERS_OVERALL,
                'actions' => [
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);

        $this->actingAs($auth);

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
