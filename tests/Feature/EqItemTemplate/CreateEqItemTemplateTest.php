<?php

namespace Tests\Feature\EqItemTemplate;

use App\Models\Resource;
use App\Services\ManufacturerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class CreateEqItemTemplateTest extends TestCase
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
                'suffix' => Resource::RES_EQUIPMENT_RESOURCES_OVERALL,
                'actions' => [
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Correct data
     * Expected: Template created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_eq_item_template_success(): void
    {
        // Arrange
        $form = $this->getCorrectForm();

        // Act
        $response = $this->post(
            route('eqItemTemplates.store'),
            $form,
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_item_templates', $form);
        $response->assertRedirect(route('eqItemTemplates.index'));
    }

    /**
     * Returns form that will pass validation
     *
     * @author Mariusz Waloszczyk
     */
    private function getCorrectForm(): array
    {
        $category = 1; // temporary
        $manufacturer = ManufacturerService::getRandomManufacturer();

        return [
            'name' => 'test template',
            'eq_item_category_id' => $category,
            'manufacturer_id' => $manufacturer->id,
            'has_vehicle' => true,
            'has_construction_number' => true,
            'has_inventory_number' => true,
            'has_identification_number' => true,
            'has_date_expiry' => true,
            'has_date_legalisation' => true,
            'has_date_legalisation_due' => true,
            'has_date_production' => true,
        ];
    }
}
