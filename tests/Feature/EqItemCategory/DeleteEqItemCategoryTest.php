<?php

namespace Tests\Feature\EqItemCategory;

use App\Models\EqItemCategory;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Piotr Nagórny
 */
class DeleteEqItemCategoryTest extends TestCase
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
                    Resource::ACTION_DELETE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Correct data
     * Expect: Category deleted
     *
     * @author Piotr Nagórny
     */
    public function test_delete_unit_success(): void
    {
        // Arrange
        $sampleUnit = EqItemCategory::factory()->create();

        // Act
        $response = $this->delete(
            route(
                'eqItemCategories.destroy',
                $sampleUnit
            )
        );

        // Assert
        $this->assertModelMissing($sampleUnit);
        $response->assertRedirect(route('eqItemCategories.index'));
    }
}
