<?php

namespace Tests\Feature\FireBrigadeUnit;

use App\Models\FireBrigadeUnit;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class CreateFireBrigadeUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    public function setUp(): void
    {
        parent::setUp();

        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
                'actions' => [
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Correct data
     * Expect: Unit created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_unit_success(): void
    {
        // Arrange
        $superiorUnit = FireBrigadeUnit::factory()->create();

        $params = [
            'name' => 'test',
            'addr_street' => 'test',
            'addr_number' => 'test',
            'addr_postcode' => '44-240',
            'addr_locality' => 'test',
            'superior_unit_id' => $superiorUnit->id,
        ];

        // Act
        $response = $this->post(
            route('fireBrigadeUnits.store'),
            $params,
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('fire_brigade_units', $params);
        $response->assertRedirect(route('fireBrigadeUnits.index'));
    }
}
