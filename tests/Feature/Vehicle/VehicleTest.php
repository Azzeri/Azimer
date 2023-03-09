<?php

namespace Tests\Feature;

use App\Models\AclResource;
use App\Models\FireBrigadeUnit;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @author Piotr Nagórny
     */
    public function test_index(): void
    {
        $userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT,
            AclResource::ACTION_VIEW_ANY
        );
        $this->actingAs($userWithPermission);

        $response = $this->get(route('vehicles.index'));

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @author Piotr Nagórny
     */
    public function test_store_vehicle(): void
    {
        $userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT,
            AclResource::ACTION_CREATE
        );
        $this->actingAs($userWithPermission);

        $unit = FireBrigadeUnit::factory()->create();

        $params = [
            'number' => 'test number',
            'name' => 'test vehicle',
            'fire_brigade_unit_id' => $unit->id,
        ];

        $response = $this->post(route('vehicles.store'), $params);

        $response->assertValid();
        $this->assertDatabaseHas('vehicles', $params);
        $response->assertRedirect(route('vehicles.index'));
    }

    /**
     * A basic feature test example.
     *
     * @author Piotr Nagórny
     */
    public function test_update_vehicle(): void
    {
        $userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT,
            AclResource::ACTION_UPDATE
        );
        $this->actingAs($userWithPermission);

        $unit = FireBrigadeUnit::factory()->create();

        $currentVehicleParams = [
            'number' => '123',
            'name' => 'current_name',
            'fire_brigade_unit_id' => $unit->id,
        ];
        $updatedVehicleParams = [
            'number' => '321',
            'name' => 'updated_name',
            'fire_brigade_unit_id' => $unit->id,
        ];

        $vehicle = Vehicle::factory()->create([
            'fire_brigade_unit_id' => $unit->id,
        ]);

        $request = [
            'number' => $updatedVehicleParams['number'],
            'name' => $updatedVehicleParams['name'],
            'fire_brigade_unit_id' => $updatedVehicleParams['fire_brigade_unit_id'],
        ];

        $response = $this->put(
            route('vehicles.update', $vehicle->number),
            $request
        );

        $this->assertDatabaseHas('vehicles', $updatedVehicleParams);
    }

    /**
     * A basic feature test example.
     *
     * @author Piotr Nagórny
     */
    public function test_delete_vehicle(): void
    {
        $userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT,
            AclResource::ACTION_DELETE
        );
        $this->actingAs($userWithPermission);

        $unit = FireBrigadeUnit::factory()->create();

        $vehicle = Vehicle::factory()->create([
            'fire_brigade_unit_id' => $unit->id,
        ]);
        $response = $this->delete(route('vehicles.destroy', $vehicle));

        $response->assertRedirect(route('vehicles.index'));
        $this->assertModelMissing($vehicle);
    }
}
