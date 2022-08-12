<?php

namespace Tests\Feature\FireBrigadeUnit;

use App\Models\FireBrigadeUnit;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateFireBrigadeUnitTest extends TestCase
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
                    Resource::ACTION_UPDATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Correct data
     * Expect: Unit updated
     *
     * @author Mariusz Waloszczyk
     */
    public function test_update_unit_success(): void
    {
        // Arrange
        $sampleUnit = FireBrigadeUnit::factory()->create();
        $sampleSuperiorUnit = FireBrigadeUnit::factory()->create();

        $request = [
            'name' => 'updatedName',
            'addr_street' => 'updatedStreet',
            'addr_number' => '1234',
            'addr_locality' => 'updatedPlace',
            'addr_postcode' => '00-000',
            'superior_unit_id' => $sampleSuperiorUnit->id,
        ];

        // Act
        $response = $this->put(
            route(
                'fireBrigadeUnits.update',
                $sampleUnit->id
            ),
            $request
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('fire_brigade_units', $request);
        $response->assertRedirect(route('fireBrigadeUnits.index'));
    }
}
