<?php

namespace Tests\Feature\EqServiceTemplate;

use App\Models\EqServiceTemplate;
use App\Models\Resource;
use App\Services\EqServiceTemplateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateEqServiceTemplateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * @var EqServiceTemplateService
     */
    private $eqServiceTemplateService;

    public function setUp(): void
    {
        parent::setUp();

        $this->eqServiceTemplateService = new EqServiceTemplateService();

        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_EQUIPMENT_RESOURCES_OVERALL,
                'actions' => [
                    Resource::ACTION_UPDATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Correct data
     * Expect: Template updated
     *
     * @author Mariusz Waloszczyk
     */
    public function test_update_eq_service_template_success(): void
    {
        // Arrange
        $template = EqServiceTemplate::factory()->create();

        $form = $this->eqServiceTemplateService->getSampleCorrectForm(false);

        // Act
        $response = $this->put(
            route(
                'eqServiceTemplates.update',
                $template->id
            ),
            $form
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_service_templates', $form);
        $response->assertRedirect(route('eqItemCategories.index'));
    }
}
