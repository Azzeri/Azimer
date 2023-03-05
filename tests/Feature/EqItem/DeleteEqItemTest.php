<?php

namespace Tests\Feature\EqItem;

use App\Models\AclResource;
use App\Models\EqItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteEqItemTest extends TestCase
{
    use RefreshDatabase;

    private User $userWithPermission;

    public function setUp(): void
    {
        parent::setUp();

        $this->userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT,
            AclResource::ACTION_DELETE
        );
        $this->actingAs($this->userWithPermission);
    }

    /**
     * Case: Correct data
     * Expect: Item deleted
     *
     * @author Mariusz Waloszczyk
     */
    public function test_delete_eq_item_success(): void
    {
        // Arrange
        $item = EqItem::factory()->create();

        // Act
        $response = $this->delete(
            route(
                'eqItems.destroy',
                $item
            )
        );

        // Assert
        $this->assertModelMissing($item);
        $response->assertRedirect(route('eqItems.index'));
    }
}
