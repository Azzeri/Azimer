<?php

namespace Tests\Feature\EqUsage;

use App\Models\Resource;
use App\Services\EqUsageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Piotr Nagórny
 */
class CreateEqUsageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * @var EqUsageService
     */
    private $eqUsageService;

    public function setUp(): void
    {
        parent::setUp();

        $this->eqUsageService = new EqUsageService();

        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => Resource::RES_EQ_USAGES,
                'actions' => [
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Correct data
     * Expected: Category created
     *
     * @author Piotr Nagórny
     */
    public function test_store_usage_success(): void
    {
        // Arrange
        $form = $this->eqUsageService->getCorrectForm();

        // Act
        $response = $this->post(
            route('eqUsages.store'),
            $form,
        );
        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_usages', $form);
        $response->assertRedirect(route('eqUsages.index'));
    }

    /**
     * Case: Invalid data
     * Expected: Validation error returned
     *
     * @dataProvider failProvider
     *
     * @author Piotr Nagórny
     */
    public function test_store_usage_fail(
        $incorrectField,
        $incorrectFieldValue
    ): void {
        // Arrange
        $form = $this->eqUsageService->getCorrectForm();
        $form[$incorrectField] = $incorrectFieldValue;

        // Act
        $response = $this->post(
            route('eqUsages.store'),
            $form,
        );

        // Assert
        $response->assertInvalid($incorrectField);
        $this->assertDatabaseMissing('eq_usages', $form);
    }

    public function failProvider()
    {
        return [
            'duration_minutes' => [
                'duration_minutes',
                '',
            ],
            'eq_item_code' => [
                'eq_item_code',
                100000000,
            ],
            'user_id' => [
                'user_id',
                100000000,
            ],
        ];
    }
}