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
        $unit = FireBrigadeUnit::factory()->create();

        $form = $this->getCorrectForm();

        // Act
        $response = $this->put(
            route(
                'fireBrigadeUnits.update',
                $unit->id
            ),
            $form
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('fire_brigade_units', $form);
        $response->assertRedirect(route('fireBrigadeUnits.index'));
    }

    /**
     * Case: Invalid data
     * Expect: Validation errors returned
     *
     * @dataProvider failProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_update_unit_fail(
        $incorrectField,
        $incorrectFieldValue
    ): void {
        // Arrange
        $unit = FireBrigadeUnit::factory()->create();

        $form = $this->getCorrectForm();
        $form[$incorrectField] = $incorrectFieldValue;

        // Act
        $response = $this->put(
            route(
                'fireBrigadeUnits.update',
                $unit->id
            ),
            $form
        );

        // Assert
        $response->assertInvalid($incorrectField);
        $this->assertDatabaseMissing('fire_brigade_units', $form);
    }

    public function failProvider()
    {
        return [
            'name' => [
                'name',
                '',
            ],
            'addr_street' => [
                'addr_street',
                '',
            ],
            'addr_number' => [
                'addr_number',
                '',
            ],
            'addr_locality' => [
                'addr_locality',
                '',
            ],
            'addr_postcode' => [
                'addr_postcode',
                '',
            ],
            'superior_unit_id' => [
                'superior_unit_id',
                1000000,
            ],
        ];
    }

    /**
     * Returns form that will pass validation
     *
     * @author Mariusz Waloszczyk
     */
    private function getCorrectForm(): array
    {
        $superiorUnit = FireBrigadeUnit::factory()->create();

        return [
            'name' => 'updatedName',
            'addr_street' => 'updatedStreet',
            'addr_number' => '1234',
            'addr_locality' => 'updatedPlace',
            'addr_postcode' => '00-000',
            'superior_unit_id' => $superiorUnit->id,
        ];
    }
}
