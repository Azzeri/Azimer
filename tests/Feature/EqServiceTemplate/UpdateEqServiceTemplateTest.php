<?php

namespace Tests\Feature\EqServiceTemplate;

use App\Models\AclResource;
use App\Models\EqServiceTemplate;
use App\Models\User;
use App\Services\EqServiceTemplateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateEqServiceTemplateTest extends TestCase
{
    use RefreshDatabase;

    private User $userWithPermission;

    private EqServiceTemplateService $eqServiceTemplateService;

    public function setUp(): void
    {
        parent::setUp();

        $this->eqServiceTemplateService = new EqServiceTemplateService();

        $this->userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_UPDATE
        );
        $this->actingAs($this->userWithPermission);
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
