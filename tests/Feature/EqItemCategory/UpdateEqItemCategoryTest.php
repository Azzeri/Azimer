<?php

namespace Tests\Feature\EqItemCategory;

use App\Models\EqItemCategory;
use App\Models\Resource;
use App\Services\EqItemCategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Piotr Nagórny
 */
class UpdateEqItemCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * @var EqItemCategoryService
     */
    private $eqItemCategoryService;

    public function setUp(): void
    {
        parent::setUp();

        $this->eqItemCategoryService = new EqItemCategoryService();

        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_EQ_ITEM_CATEGORIES_OVERALL,
                'actions' => [
                    Resource::ACTION_UPDATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Correct data
     * Expect: Category updated
     *
     * @author Mariusz Waloszczyk
     */
    public function test_update_category_success(): void
    {
        // Arrange
        $category = EqItemCategory::factory()->create();

        $form = $this->eqItemCategoryService->getCorrectForm();

        // Act
        $response = $this->put(
            route(
                'eqItemCategories.update',
                $category
            ),
            $form
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_item_categories', $form);
        $response->assertRedirect(route('eqItemCategories.index'));
    }

    /**
     * Case: Invalid data
     * Expect: Validation errors returned
     *
     * @dataProvider failProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_update_category_fail(
        $incorrectField,
        $incorrectFieldValue
    ): void {
        // Arrange
        $eqItemCategory = EqItemCategory::factory()->create();

        $form = $this->eqItemCategoryService->getCorrectForm();
        $form[$incorrectField] = $incorrectFieldValue;

        // Act
        $response = $this->put(
            route(
                'eqItemCategories.update',
                $eqItemCategory->id
            ),
            $form
        );

        // Assert
        $response->assertInvalid($incorrectField);
        $this->assertDatabaseMissing('eq_item_categories', $form);
    }

    public function failProvider()
    {
        return [
            'name' => [
                'name',
                '',
            ],
            'is_fillable' => [
                'is_fillable',
                '',
            ],
            'parent_category_id' => [
                'parent_category_id',
                1000000,
            ],
        ];
    }
}
