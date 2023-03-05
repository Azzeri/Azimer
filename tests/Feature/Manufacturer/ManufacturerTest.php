<?php

namespace Tests\Feature;

use App\Models\AclResource;
use App\Models\Manufacturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Piotr Nagórny
 */
class ManufacturerTest extends TestCase
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
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_VIEW_ANY
        );
        $this->actingAs($userWithPermission);

        $response = $this->get(route('manufacturers.index'));

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @author Piotr Nagórny
     */
    public function test_store(): void
    {
        $userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_CREATE
        );
        $this->actingAs($userWithPermission);

        $params = [
            'name' => 'test manufacturer',
        ];

        $response = $this->post(route('manufacturers.store'), $params);
        $response->assertValid();

        $this->assertDatabaseHas('manufacturers', $params);
    }

    /**
     * A basic feature test example.
     *
     * @author Piotr Nagórny
     */
    public function test_update(): void
    {
        $userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_UPDATE
        );
        $this->actingAs($userWithPermission);

        $currentManufacturerParams = [
            'name' => 'current_name',
        ];
        $updatedManufacturerParams = [
            'name' => 'updated_name',
        ];

        $manufacturer = Manufacturer::factory()->create();

        $request = [
            'name' => $updatedManufacturerParams['name'],
        ];
        $response = $this->put(
            route('manufacturers.update', $manufacturer),
            $request
        );

        $this->assertDatabaseHas('manufacturers', $updatedManufacturerParams);
    }

    /**
     * A basic feature test example.
     *
     * @author Piotr Nagórny
     */
    public function test_delete(): void
    {
        $userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_DELETE
        );
        $this->actingAs($userWithPermission);

        $manufacturer = Manufacturer::factory()->create();
        $response = $this->delete(route('manufacturers.destroy', $manufacturer));

        $this->assertModelMissing($manufacturer);
        $response->assertRedirect((route('manufacturers.index')));
    }
}
