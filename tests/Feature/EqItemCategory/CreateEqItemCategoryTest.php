<?php

namespace Tests\Feature\EqItemCategory;

use App\Models\Resource;
use App\Services\EqItemCategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Piotr Nagórny
 */
class CreateEqItemCategoryTest extends TestCase
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
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Correct data
     * Expected: Unit created
     *
     * @author Piotr Nagórny
     */
    public function test_store_category_success(): void
    {
        // Arrange
        $form = $this->eqItemCategoryService->getCorrectForm();

        // Act
        $response = $this->post(
            route('eqItemCategories.store'),
            $form,
        );
        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_item_categories', $form);
        $response->assertRedirect(route('eqItemCategories.index'));
    }

    /**
     * Case: Invalid data
     * Expected: Validation error returned
     *
     * @dataProvider failProvider
     *
     * @author Piotr Nagórny
     */
    public function test_store_category_fail(
        $incorrectField,
        $incorrectFieldValue
    ): void {
        // Arrange
        $form = $this->eqItemCategoryService->getCorrectForm();
        $form[$incorrectField] = $incorrectFieldValue;

        // Act
        $response = $this->post(
            route('eqItemCategories.store'),
            $form,
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
