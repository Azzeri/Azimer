<?php

namespace Tests\Feature\EqFill;

use App\Models\AclResource;
use App\Services\EqFillService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class CreateEqFillTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * @var EqFillService
     */
    private $eqFillService;

    public function setUp(): void
    {
        parent::setUp();

        $this->eqFillService = new EqFillService();

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
     * Expected: Fill created
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_fill_success(): void
    {
        // Arrange
        $form = $this->eqFillService->getCorrectForm();

        // Act
        $response = $this->post(
            route('eqFills.store'),
            $form,
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_fills', $form);
    }

    /**
     * Case: Invalid data
     * Expected: Validation error returned
     *
     * @dataProvider failProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_store_fill_fail(
        $incorrectField,
        $incorrectFieldValue
    ): void {
        // Arrange
        $form = $this->eqFillService->getCorrectForm();
        $form[$incorrectField] = $incorrectFieldValue;

        // Act
        $response = $this->post(
            route('eqFills.store'),
            $form,
        );

        // Assert
        $response->assertInvalid($incorrectField);
        $this->assertDatabaseMissing('eq_fills', $form);
    }

    public function failProvider()
    {
        return [
            'started_at' => [
                'started_at',
                Carbon::now()->addDays(1),
            ],
            'finished_at' => [
                'finished_at',
                'invalid',
            ],
            'eq_item_code' => [
                'eq_item_code',
                100000000,
            ],
        ];
    }
}
