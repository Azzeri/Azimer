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
class EqItemCategoryAccessTest extends TestCase
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
    }

    /**
     * Tests index access with different resources
     *
     * @dataProvider indexProvider
     *
     * @author Piotr Nagórny
     */
    public function test_index_access($forbidden, $resource)
    {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_VIEW_ANY,
                ],
            ],
        ]);
        $this->actingAs($auth);

        // Act
        $response = $this->get(
            route(
                'eqItemCategories.index',
            )
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertOk();
        }
    }

    public function indexProvider()
    {
        return [
            'overall category' => [
                false,
                Resource::RES_EQ_ITEM_CATEGORIES_OVERALL,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests store access with different resources
     *
     * @dataProvider storeProvider
     *
     * @author Piotr Nagórny
     */
    public function test_store_access(
        $forbidden,
        $resource,
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $form = $this->eqItemCategoryService->getCorrectForm();

        // Act
        $response = $this->post(
            route('eqItemCategories.store'),
            $form,
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertStatus(302);
        }
    }

    public function storeProvider()
    {
        return [
            'overall category' => [
                false,
                Resource::RES_EQ_ITEM_CATEGORIES_OVERALL,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests update access with different resources
     *
     * @dataProvider updateProvider
     *
     * @author Piotr Nagórny
     */
    public function test_update_access(
        $forbidden,
        $resource,
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_UPDATE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $form = $this->eqItemCategoryService->getCorrectForm();
        $category = EqItemCategory::factory()->create();

        // Act
        $response = $this->put(
            route(
                'eqItemCategories.update',
                $category,
            ),
            $form
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertStatus(302);
        }
    }

    public function updateProvider()
    {
        return [
            'overall category' => [
                false,
                Resource::RES_EQ_ITEM_CATEGORIES_OVERALL,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests delete access with different resources
     *
     * @dataProvider deleteProvider
     *
     * @author Piotr Nagórny
     */
    public function test_delete_access(
        $forbidden,
        $resource,
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_DELETE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $category = EqItemCategory::factory()->create();

        // Act
        $response = $this->delete(
            route(
                'eqItemCategories.destroy',
                $category
            ),
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertStatus(302);
        }
    }

    public function deleteProvider()
    {
        return [
            'overall category' => [
                false,
                Resource::RES_EQ_ITEM_CATEGORIES_OVERALL,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }
}
