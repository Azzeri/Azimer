<?php

namespace Tests\Feature\EqItem;

use App\Models\AclResource;
use App\Models\EqItem;
use App\Models\User;
use App\Services\EqItemService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateEqItemTest extends TestCase
{
    use RefreshDatabase;

    private User $userWithPermission;

    private EqItemService $eqItemService;

    public function setUp(): void
    {
        parent::setUp();

        $this->eqItemService = new EqItemService();

        $this->userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT,
            AclResource::ACTION_UPDATE
        );
        $this->actingAs($this->userWithPermission);
    }

    /**
     * Case: Correct data
     * Expect: Item updated
     *
     * @author Mariusz Waloszczyk
     */
    public function test_update_eq_item_success(): void
    {
        // Arrange
        $item = EqItem::factory()->create();

        $form = $this->eqItemService->getSampleCorrectForm();
        $form['name'] = $item->name;
        $form['eq_item_template_id'] = $item->eq_item_template_id;

        // Act
        $response = $this->put(
            route(
                'eqItems.update',
                $item->code
            ),
            $form
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_items', $form);
    }
}
