<?php

namespace Tests\Feature\EqServiceTemplate;

use App\Models\AclResource;
use App\Models\EqServiceTemplate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteEqServiceTemplateTest extends TestCase
{
    use RefreshDatabase;

    private User $userWithPermission;

    public function setUp(): void
    {
        parent::setUp();

        $this->userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_DELETE
        );
        $this->actingAs($this->userWithPermission);
    }

    /**
     * Case: Correct data
     * Expect: Template deleted
     *
     * @author Mariusz Waloszczyk
     */
    public function test_delete_eq_service_template_success(): void
    {
        // Arrange
        $template = EqServiceTemplate::factory()->create();

        // Act
        $response = $this->delete(
            route(
                'eqServiceTemplates.destroy',
                $template
            )
        );

        // Assert
        $this->assertModelMissing($template);
        $response->assertRedirect(route('eqItemCategories.index'));
    }
}
