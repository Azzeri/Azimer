<?php

namespace Tests\Feature;

use App\Models\Manufacturer;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Piotr Nagórny
 */
class ManufacturerTest extends TestCase
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
                'suffix' => Resource::RES_EQUIPMENT_RESOURCES_OVERALL,
                'actions' => [
                    Resource::ACTION_VIEW_ANY,
                ],
            ],
        ]);

        $this->actingAs($auth);

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
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_EQUIPMENT_RESOURCES_OVERALL,
                'actions' => [
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);

        $this->actingAs($auth);

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
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_EQUIPMENT_RESOURCES_OVERALL,
                'actions' => [
                    Resource::ACTION_UPDATE,
                ],
            ],
        ]);

        $this->actingAs($auth);

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
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_EQUIPMENT_RESOURCES_OVERALL,
                'actions' => [
                    Resource::ACTION_DELETE,
                ],
            ],
        ]);

        $this->actingAs($auth);

        $manufacturer = Manufacturer::factory()->create();
        $response = $this->delete(route('manufacturers.destroy', $manufacturer));

        $this->assertModelMissing($manufacturer);
        $response->assertRedirect((route('manufacturers.index')));
    }
}
