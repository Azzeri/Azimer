<?php

namespace Tests\Feature\EqServiceTemplate;

use App\Models\EqServiceTemplate;
use App\Models\AclResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteEqServiceTemplateTest extends TestCase
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
                'suffix' => AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
                'actions' => [
                    AclResource::ACTION_DELETE,
                ],
            ],
        ]);

        $this->actingAs($auth);
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
