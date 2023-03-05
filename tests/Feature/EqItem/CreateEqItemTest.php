<?php

namespace Tests\Feature\EqItem;

use App\Models\AclResource;
use App\Models\User;
use App\Services\EqItemService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class CreateEqItemTest extends TestCase
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
            AclResource::ACTION_CREATE
        );
        $this->actingAs($this->userWithPermission);
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
