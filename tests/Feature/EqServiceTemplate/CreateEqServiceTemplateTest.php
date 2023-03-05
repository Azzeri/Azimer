<?php

namespace Tests\Feature\EqServiceTemplate;

use App\Models\AclResource;
use App\Models\User;
use App\Services\EqServiceTemplateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class CreateEqServiceTemplateTest extends TestCase
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
            AclResource::ACTION_CREATE
        );
        $this->actingAs($this->userWithPermission);
    }

    /**
     * Case: Correct data
     * Expected: Template created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_eq_service_template_success(): void
    {
        // Arrange
        $form = $this->eqServiceTemplateService->getSampleCorrectForm(true);

        // Act
        $response = $this->post(
            route('eqServiceTemplates.store'),
            $form,
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_service_templates', $form);
        $response->assertRedirect(route('eqItemCategories.index'));
    }
}
