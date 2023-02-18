<?php

namespace Tests\Feature\EqItem;

use App\Models\EqItem;
use App\Models\AclResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteEqItemTest extends TestCase
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
                'suffix' => AclResource::RES_OVERALL_EQUIPMENT,
                'actions' => [
                    AclResource::ACTION_DELETE,
                ],
            ],
        ]);

        $this->actingAs($auth);
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
