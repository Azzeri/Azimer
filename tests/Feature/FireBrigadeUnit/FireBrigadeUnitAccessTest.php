<?php

namespace Tests\Feature\FireBrigadeUnit;

use App\Models\FireBrigadeUnit;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class FireBrigadeUnitAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Tests index access with different resources
     *
     * @dataProvider indexProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_index_access($forbidden, $resource)
    {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_VIEW_ANY,
                ],
            ],
        ]);
        $this->actingAs($auth);

        // Act
        $response = $this->get(
            route(
                'fireBrigadeUnits.index',
            )
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertOk();
        }
    }

    public function indexProvider()
    {
        return [
            'overall units' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            ],
            'own unit' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNIT_OWN,
            ],
            'lowly units' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNITS_LOWLY,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests show access with different resources
     *
     * @dataProvider showProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_show_access(
        $forbidden,
        $resource,
        $sendLowlyUnit = false
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_VIEW,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $lowlyUnit = FireBrigadeUnit::factory()
            ->withSuperiorUnit()
            ->create();
        $superiorUnit = $lowlyUnit->superiorFireBrigadeUnit;
        $auth->fireBrigadeUnit = $superiorUnit;
        $requestUnit = $sendLowlyUnit
            ? $lowlyUnit
            : $superiorUnit;

        // Act
        $response = $this->get(
            route(
                'fireBrigadeUnits.show',
                $requestUnit
            )
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertOk();
        }
    }

    public function showProvider()
    {
        return [
            'overall units' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            ],
            'own unit' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNIT_OWN,
            ],
            'lowly units' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNITS_LOWLY,
                true,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests store access with different resources
     *
     * @dataProvider storeProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_access(
        $forbidden,
        $resource,
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $form = $this->getCorrectForm();

        // Act
        $response = $this->post(
            route('fireBrigadeUnits.store'),
            $form
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertStatus(302);
        }
    }

    public function storeProvider()
    {
        return [
            'overall units' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests update access with different resources
     *
     * @dataProvider updateProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_update_access(
        $forbidden,
        $resource,
        $sendLowlyUnit = false
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_UPDATE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $lowlyUnit = FireBrigadeUnit::factory()
            ->withSuperiorUnit()
            ->create();
        $superiorUnit = $lowlyUnit->superiorFireBrigadeUnit;
        $auth->fireBrigadeUnit = $superiorUnit;
        $requestUnit = $sendLowlyUnit
            ? $lowlyUnit
            : $superiorUnit;
        $form = $this->getCorrectForm();

        // Act
        $response = $this->put(
            route(
                'fireBrigadeUnits.update',
                $requestUnit,
            ),
            $form
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertStatus(302);
        }
    }

    public function updateProvider()
    {
        return [
            'overall units' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            ],
            'own unit' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNIT_OWN,
            ],
            'lowly units' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNITS_LOWLY,
                true,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests delete access with different resources
     *
     * @dataProvider deleteProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_delete_access(
        $forbidden,
        $resource,
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_DELETE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $unit = FireBrigadeUnit::factory()->create();

        // Act
        $response = $this->delete(
            route(
                'fireBrigadeUnits.destroy',
                $unit
            ),
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertStatus(302);
        }
    }

    public function deleteProvider()
    {
        return [
            'overall units' => [
                false,
                Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
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
        return [
            'name' => 'test',
            'addr_street' => 'test',
            'addr_number' => '1234',
            'addr_locality' => 'test',
            'addr_postcode' => '48-000',
        ];
    }
}
