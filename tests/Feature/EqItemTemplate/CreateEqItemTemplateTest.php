<?php

namespace Tests\Feature\EqItemTemplate;

use App\Models\Resource;
use App\Services\EqItemTemplateService;
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

    /**
     * @var EqItemTemplateService
     */
    private $eqItemTemplateService;

    public function setUp(): void
    {
        parent::setUp();

        $this->eqItemTemplateService = new EqItemTemplateService();

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
        $form = $this->eqItemTemplateService->getSampleCorrectForm();

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
}
