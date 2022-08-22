<?php

namespace Tests\Feature\FireBrigadeUnit;

use App\Models\FireBrigadeUnit;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteFireBrigadeUnitTest extends TestCase
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
                    Resource::ACTION_DELETE,
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
    public function test_delete_unit_success(): void
    {
        // Arrange
        $sampleUnit = FireBrigadeUnit::factory()->create();
        $childUnit = FireBrigadeUnit::factory()->create();
        $user = User::factory()->create();

        $childUnit->update([
            'superior_unit_id' => $sampleUnit->id,
        ]);
        $user->update([
            'fire_brigade_unit_id' => $sampleUnit->id,
        ]);

        // Act
        $response = $this->delete(
            route(
                'fireBrigadeUnits.destroy',
                $sampleUnit
            )
        );

        // Assert
        $this->assertSoftDeleted($sampleUnit);
        // $this->assertNull($childUnit->superior_unit_id);
        // $this->assertNull($user->fire_brigade_unit_id);
        $response->assertRedirect(route('fireBrigadeUnits.index'));
    }
}
