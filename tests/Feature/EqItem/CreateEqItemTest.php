<?php

namespace Tests\Feature\EqItem;

use App\Models\AclResource;
use App\Services\EqItemService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class CreateEqItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * @var EqItemService
     */
    private $eqItemService;

    public function setUp(): void
    {
        parent::setUp();

        $this->eqItemService = new EqItemService();

        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => AclResource::RES_OVERALL_EQUIPMENT,
                'actions' => [
                    AclResource::ACTION_CREATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Correct data
     * Expected: Item created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_eq_item_success(): void
    {
        // Arrange
        $form = $this->eqItemService->getSampleCorrectForm();

        // Act
        $response = $this->post(
            route('eqItems.store'),
            $form,
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_items', $form);
        $response->assertRedirect(route('eqItems.index'));
    }
}
