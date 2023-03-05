<?php

namespace Tests\Feature\EqItemCategory;

use App\Models\AclResource;
use App\Models\EqItemCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Piotr Nagórny
 */
class DeleteEqItemCategoryTest extends TestCase
{
    use RefreshDatabase;

    private User $userWithPermission;

    public function setUp(): void
    {
        parent::setUp();

        $this->userWithPermission = $this->getUserWithOneResourceAndAction(
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_DELETE
        );
        $this->actingAs($this->userWithPermission);
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
