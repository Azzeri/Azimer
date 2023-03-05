<?php

namespace Tests\Feature\FireBrigadeUnit;

use App\Models\AclResource;
use App\Models\FireBrigadeUnit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class CreateFireBrigadeUnitTest extends TestCase
{
    use RefreshDatabase;

    private User $userWithPermission;

    public function setUp(): void
    {
        parent::setUp();

        $this->userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_FIRE_BRIGADE_UNITS,
            AclResource::ACTION_CREATE
        );
        $this->actingAs($this->userWithPermission);
    }

    /**
     * Case: Correct data
     * Expected: Unit created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_unit_success(): void
    {
        // Arrange
        $form = $this->getCorrectForm();

        // Act
        $response = $this->post(
            route('fireBrigadeUnits.store'),
            $form,
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('fire_brigade_units', $form);
        $response->assertRedirect(route('fireBrigadeUnits.index'));
    }

    /**
     * Case: Invalid data
     * Expected: Validation error returned
     *
     * @dataProvider failProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_unit_fail(
        $incorrectField,
        $incorrectFieldValue
    ): void {
        // Arrange
        $form = $this->getCorrectForm();
        $form[$incorrectField] = $incorrectFieldValue;

        // Act
        $response = $this->post(
            route('fireBrigadeUnits.store'),
            $form,
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
            'name' => 'test',
            'addr_street' => 'test',
            'addr_number' => '1234',
            'addr_locality' => 'test',
            'addr_postcode' => '48-000',
            'superior_unit_id' => $superiorUnit->id,
        ];
    }
}
