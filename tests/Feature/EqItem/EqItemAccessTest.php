<?php

namespace Tests\Feature\EqItem;

use App\Models\AclResource;
use App\Models\EqItem;
use App\Models\FireBrigadeUnit;
use App\Services\EqItemService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemAccessTest extends TestCase
{
    // use RefreshDatabase;

    // /**
    //  * Indicates whether the default seeder should run before each test.
    //  *
    //  * @var bool
    //  */
    // protected $seed = true;

    // /**
    //  * @var EqItemService
    //  */
    // private $eqItemService;

    // public function setUp(): void
    // {
    //     parent::setUp();

    //     $this->eqItemService = new EqItemService();
    // }

    // /**
    //  * Tests index access with different resources
    //  *
    //  * @dataProvider indexProvider
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_index_access($forbidden, $resource)
    // {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => $resource,
    //             'actions' => [
    //                 AclResource::ACTION_VIEW,
    //             ],
    //         ],
    //     ]);
    //     $unit = FireBrigadeUnit::factory()->create();
    //     $auth->update([
    //         'fire_brigade_unit_id' => $unit->id,
    //     ]);
    //     $this->actingAs($auth);

    //     // Act
    //     $response = $this->get(
    //         route(
    //             'eqItems.index',
    //         )
    //     );

    //     // Assert
    //     if ($forbidden) {
    //         $response->assertForbidden();
    //     } else {
    //         $response->assertOk();
    //     }
    // }

    // public function indexProvider()
    // {
    //     return [
    //         'overall equipment' => [
    //             false,
    //             AclResource::RES_OVERALL_EQUIPMENT,
    //         ],
    //         'own unit equipment' => [
    //             false,
    //             AclResource::RES_OWN_UNIT_EQUIPMENT,
    //         ],
    //         'lowly units equipment' => [
    //             false,
    //             AclResource::RES_LOWLY_UNITS_EQUIPMENT,
    //         ],
    //         'forbidden' => [
    //             true,
    //             AclResource::RES_DUMMY,
    //         ],
    //     ];
    // }

    // /**
    //  * Tests show access with different resources
    //  *
    //  * @dataProvider showProvider
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_show_access(
    //     $forbidden,
    //     $resource,
    //     $sendLowlyUnit = false
    // ) {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => $resource,
    //             'actions' => [
    //                 AclResource::ACTION_VIEW,
    //             ],
    //         ],
    //     ]);
    //     $this->actingAs($auth);

    //     $lowlyUnit = FireBrigadeUnit::factory()
    //         ->withSuperiorUnit()
    //         ->create();
    //     $superiorUnit = $lowlyUnit->superiorFireBrigadeUnit;
    //     $auth->fireBrigadeUnit = $superiorUnit;
    //     $requestUnit = $sendLowlyUnit
    //         ? $lowlyUnit
    //         : $superiorUnit;

    //     $item = EqItem::factory()->create();

    //     $item->update([
    //         'fire_brigade_unit_id' => $requestUnit->id,
    //     ]);

    //     // Act
    //     $response = $this->get(
    //         route(
    //             'eqItems.show',
    //             $item
    //         )
    //     );

    //     // Assert
    //     if ($forbidden) {
    //         $response->assertForbidden();
    //     } else {
    //         $response->assertOk();
    //     }
    // }

    // public function showProvider()
    // {
    //     return [
    //         'overall equipment' => [
    //             false,
    //             AclResource::RES_OVERALL_EQUIPMENT,
    //         ],
    //         'own unit equipment' => [
    //             false,
    //             AclResource::RES_OWN_UNIT_EQUIPMENT,
    //         ],
    //         'lowly units equipment' => [
    //             false,
    //             AclResource::RES_LOWLY_UNITS_EQUIPMENT,
    //             true,
    //         ],
    //         'forbidden' => [
    //             true,
    //             AclResource::RES_DUMMY,
    //         ],
    //     ];
    // }

    // /**
    //  * Tests store access with different resources
    //  *
    //  * @dataProvider storeProvider
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_store_access(
    //     $forbidden,
    //     $resource,
    // ) {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => $resource,
    //             'actions' => [
    //                 AclResource::ACTION_CREATE,
    //             ],
    //         ],
    //     ]);
    //     $this->actingAs($auth);

    //     $form = $this->eqItemService->getSampleCorrectForm();

    //     // Act
    //     $response = $this->post(
    //         route('eqItems.store'),
    //         $form
    //     );

    //     // Assert
    //     if ($forbidden) {
    //         $response->assertForbidden();
    //     } else {
    //         $response->assertStatus(302);
    //     }
    // }

    // public function storeProvider()
    // {
    //     return [
    //         'overall units equipment' => [
    //             false,
    //             AclResource::RES_OVERALL_EQUIPMENT,
    //         ],
    //         'own unit equipment' => [
    //             false,
    //             AclResource::RES_OWN_UNIT_EQUIPMENT,
    //         ],
    //         'lowly units equipment' => [
    //             false,
    //             AclResource::RES_LOWLY_UNITS_EQUIPMENT,
    //         ],
    //         'forbidden' => [
    //             true,
    //             AclResource::RES_DUMMY,
    //         ],
    //     ];
    // }

    // /**
    //  * Tests update access with different resources
    //  *
    //  * @dataProvider updateProvider
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_update_access(
    //     $forbidden,
    //     $resource,
    //     $sendLowlyUnit = false
    // ) {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => $resource,
    //             'actions' => [
    //                 AclResource::ACTION_UPDATE,
    //             ],
    //         ],
    //     ]);
    //     $this->actingAs($auth);

    //     $lowlyUnit = FireBrigadeUnit::factory()
    //         ->withSuperiorUnit()
    //         ->create();
    //     $superiorUnit = $lowlyUnit->superiorFireBrigadeUnit;
    //     $auth->fireBrigadeUnit = $superiorUnit;
    //     $requestUnit = $sendLowlyUnit
    //         ? $lowlyUnit
    //         : $superiorUnit;
    //     $form = $this->eqItemService->getSampleCorrectForm();

    //     $item = EqItem::factory()->create();

    //     $item->update([
    //         'fire_brigade_unit_id' => $requestUnit->id,
    //     ]);

    //     // Act
    //     $response = $this->put(
    //         route(
    //             'eqItems.update',
    //             $item,
    //         ),
    //         $form
    //     );

    //     // Assert
    //     if ($forbidden) {
    //         $response->assertForbidden();
    //     } else {
    //         $response->assertStatus(302);
    //     }
    // }

    // public function updateProvider()
    // {
    //     return [
    //         'overall units equipment' => [
    //             false,
    //             AclResource::RES_OVERALL_EQUIPMENT,
    //         ],
    //         'own unit equipment' => [
    //             false,
    //             AclResource::RES_OWN_UNIT_EQUIPMENT,
    //         ],
    //         'lowly units equipment' => [
    //             false,
    //             AclResource::RES_LOWLY_UNITS_EQUIPMENT,
    //             true,
    //         ],
    //         'forbidden' => [
    //             true,
    //             AclResource::RES_DUMMY,
    //         ],
    //     ];
    // }

    // /**
    //  * Tests delete access with different resources
    //  *
    //  * @dataProvider deleteProvider
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_delete_access(
    //     $forbidden,
    //     $resource,
    //     $sendLowlyUnit = false
    // ) {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => $resource,
    //             'actions' => [
    //                 AclResource::ACTION_DELETE,
    //             ],
    //         ],
    //     ]);
    //     $this->actingAs($auth);

    //     $lowlyUnit = FireBrigadeUnit::factory()
    //         ->withSuperiorUnit()
    //         ->create();
    //     $superiorUnit = $lowlyUnit->superiorFireBrigadeUnit;
    //     $auth->fireBrigadeUnit = $superiorUnit;
    //     $requestUnit = $sendLowlyUnit
    //         ? $lowlyUnit
    //         : $superiorUnit;

    //     $item = EqItem::factory()->create();

    //     $item->update([
    //         'fire_brigade_unit_id' => $requestUnit->id,
    //     ]);

    //     // Act
    //     $response = $this->delete(
    //         route(
    //             'eqItems.destroy',
    //             $item
    //         ),
    //     );

    //     // Assert
    //     if ($forbidden) {
    //         $response->assertForbidden();
    //     } else {
    //         $response->assertStatus(302);
    //     }
    // }

    // public function deleteProvider()
    // {
    //     return [
    //         'overall units equipment' => [
    //             false,
    //             AclResource::RES_OVERALL_EQUIPMENT,
    //         ],
    //         'own unit equipment' => [
    //             false,
    //             AclResource::RES_OWN_UNIT_EQUIPMENT,
    //         ],
    //         'lowly units equipment' => [
    //             false,
    //             AclResource::RES_LOWLY_UNITS_EQUIPMENT,
    //             true,
    //         ],
    //         'forbidden' => [
    //             true,
    //             AclResource::RES_DUMMY,
    //         ],
    //     ];
    // }

    // /**
    //  * Tests activateService access with different resources
    //  *
    //  * @dataProvider activateServiceProvider
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_activate_service_access(
    //     $forbidden,
    //     $resource,
    //     $sendLowlyUnit = false
    // ) {
    //     // Arrange
    //     $auth = $this->getUserWithResourcesAndActions([
    //         [
    //             'suffix' => $resource,
    //             'actions' => [
    //                 AclResource::ACTION_UPDATE,
    //             ],
    //         ],
    //     ]);
    //     $this->actingAs($auth);

    //     $lowlyUnit = FireBrigadeUnit::factory()
    //         ->withSuperiorUnit()
    //         ->create();
    //     $superiorUnit = $lowlyUnit->superiorFireBrigadeUnit;
    //     $auth->fireBrigadeUnit = $superiorUnit;
    //     $requestUnit = $sendLowlyUnit
    //         ? $lowlyUnit
    //         : $superiorUnit;

    //     $item = EqItem::factory()->create();

    //     $item->update([
    //         'fire_brigade_unit_id' => $requestUnit->id,
    //     ]);

    //     // Act
    //     $response = $this->put(
    //         route(
    //             'eqItems.activateService',
    //             $item
    //         ),
    //         []
    //     );

    //     // Assert
    //     if ($forbidden) {
    //         $response->assertForbidden();
    //     } else {
    //         $response->assertStatus(302);
    //     }
    // }

    // public function activateServiceProvider()
    // {
    //     return [
    //         'overall units equipment' => [
    //             false,
    //             AclResource::RES_OVERALL_EQUIPMENT,
    //         ],
    //         'own unit equipment' => [
    //             false,
    //             AclResource::RES_OWN_UNIT_EQUIPMENT,
    //         ],
    //         'lowly units equipment' => [
    //             false,
    //             AclResource::RES_LOWLY_UNITS_EQUIPMENT,
    //             true,
    //         ],
    //         'forbidden' => [
    //             true,
    //             AclResource::RES_DUMMY,
    //         ],
    //     ];
    // }
}
