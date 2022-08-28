<?php

namespace Tests\Feature\FireBrigadeUnit;

use App\Models\EqItemTemplate;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteEqItemTemplateTest extends TestCase
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
                'suffix' => Resource::RES_EQUIPMENT_OVERALL,
                'actions' => [
                    Resource::ACTION_DELETE,
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
    public function test_delete_eq_item_template_success(): void
    {
        // Arrange
        $template = EqItemTemplate::factory()->create();

        // Act
        $response = $this->delete(
            route(
                'eqItemTemplates.destroy',
                $template
            )
        );

        // Assert
        $this->assertModelMissing($template);
        $response->assertRedirect(route('eqItemTemplates.index'));
    }
}
