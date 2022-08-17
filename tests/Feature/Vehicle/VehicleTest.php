<?php

namespace Tests\Feature;

use App\Models\Resource;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * A basic feature test example.
     *
     * @author Piotr Nagórny
     */
    public function test_index(): void
    {
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_VEHICLES_OVERALL,
                'actions' => [
                    Resource::ACTION_VIEW,
                ],
            ],
        ]);

        $this->actingAs($auth);

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
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_VEHICLES_OVERALL,
                'actions' => [
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
        $params = [
            'number' => 'test number',
            'name' => 'test vehicle',
        ];

        $response = $this->post(route('vehicles.store'), $params);

        $response->assertRedirect(route('vehicles.index'));
        $response->assertValid();

        $this->assertDatabaseHas('vehicles', $params);
    }

    /**
     * A basic feature test example.
     *
     * @author Piotr Nagórny
     */
    public function test_update_vehicle(): void
    {
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_VEHICLES_OVERALL,
                'actions' => [
                    Resource::ACTION_UPDATE,
                ],
            ],
        ]);

        $this->actingAs($auth);

        $currentVehicleParams = [
            'number' => '123',
            'name' => 'current_name',
        ];
        $updatedVehicleParams = [
            'number' => '321',
            'name' => 'updated_name',
        ];

        $vehicle = Vehicle::factory()->create();

        $request = [
            'number' => $updatedVehicleParams['number'],
            'name' => $updatedVehicleParams['name'],
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
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_VEHICLES_OVERALL,
                'actions' => [
                    Resource::ACTION_DELETE,
                ],
            ],
        ]);

        $this->actingAs($auth);

        $vehicle = Vehicle::factory()->create();
        $response = $this->delete(route('vehicles.destroy', $vehicle));

        $response->assertRedirect(route('vehicles.index'));
        $this->assertModelMissing($vehicle);
    }
}
