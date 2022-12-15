<?php

namespace Tests\Feature\EqItem;

use App\Models\EqServiceTemplate;
use App\Models\Resource;
use App\Services\EqItemService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class ActivateServiceTest extends TestCase
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
                'suffix' => Resource::RES_EQUIPMENT_OVERALL,
                'actions' => [
                    Resource::ACTION_UPDATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Last date field is given
     * Expected: Service template interval is added to the last date field
     *
     * @author Mariusz Waloszczyk
     */
    public function test_activate_service_with_last_date(): void
    {
        // Arrange
        $interval = 10;
        $eqServiceTemplate = EqServiceTemplate::factory()->create([
            'interval' => $interval,
        ]);
        $eqItem = EqItemService::getRandomEqItem();

        $form = [
            'eq_service_template_id' => $eqServiceTemplate->id,
            'last_service_date' => Carbon::now()->subDays(14),
        ];

        // Act
        $response = $this->put(
            route(
                'eqItems.activateService',
                $eqItem
            ),
            $form,
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_services', [
            'eq_service_template_id' => $form['eq_service_template_id'],
            'expected_perform_date' => $form['last_service_date']
                ->addDays($interval)
                ->format('y-m-d'),
        ]);
    }

    /**
     * Case: Next date field is given
     * Expected: Service date set to next date field
     *
     * @author Mariusz Waloszczyk
     */
    public function test_activate_service_with_next_date(): void
    {
        // Arrange
        $eqServiceTemplate = EqServiceTemplate::factory()->create();
        $eqItem = EqItemService::getRandomEqItem();

        $form = [
            'eq_service_template_id' => $eqServiceTemplate->id,
            'next_service_date' => Carbon::now()->addDays(14),
        ];

        // Act
        $response = $this->put(
            route(
                'eqItems.activateService',
                $eqItem
            ),
            $form,
        );

        // Assert
        $response->assertValid();
        $this->assertDatabaseHas('eq_services', [
            'eq_service_template_id' => $form['eq_service_template_id'],
            'expected_perform_date' => $form['next_service_date']
                ->format('y-m-d'),
        ]);
    }

    /**
     * Case: Invalid data
     * Expected: Validation error returned
     *
     * @dataProvider failProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_activate_service_fail(
        $incorrectField,
        $incorrectFieldValue
    ): void {
        // Arrange
        $eqServiceTemplate = EqServiceTemplate::factory()->create();
        $eqItem = EqItemService::getRandomEqItem();
        $form = [
            'eq_service_template_id' => $eqServiceTemplate->id,
            $incorrectField => $incorrectFieldValue,
        ];

        // Act
        $response = $this->put(
            route(
                'eqItems.activateService',
                $eqItem
            ),
            $form,
        );

        // Assert
        $response->assertInvalid($incorrectField);
    }

    public function failProvider()
    {
        return [
            'eq_service_template_id' => [
                'eq_service_template_id',
                999999,
            ],
            'last_service_date' => [
                'last_service_date',
                Carbon::now()->addDays(10),
            ],
            'next_service_date' => [
                'next_service_date',
                Carbon::now()->subDays(10),
            ],
        ];
    }

    // /**
    //  * Case: Dates variations
    //  * Expected: Both dates can not be in request simultaneously,
    //  * one is required if other is not present
    //  *
    //  * @dataProvider failDatesProvider
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // public function test_activate_service_dates_variants(
    //     $last_service_date,
    //     $next_service_date,
    //     $expected
    // ): void {

    //     // Arrange
    //     $eqServiceTemplate = EqServiceTemplate::factory()->create();
    //     $eqItem = EqItemService::getRandomEqItem();
    //     $form = [
    //         'eq_service_template_id' => $eqServiceTemplate->id,
    //         'last_service_date' => $last_service_date,
    //         'next_service_date' => $next_service_date,
    //     ];

    //     // Act
    //     $response = $this->put(
    //         route(
    //             'eqItems.activateService',
    //             $eqItem
    //         ),
    //         $form,
    //     );

    //     // Assert
    //     if ($expected) {
    //         $response->assertValid();
    //     }

    //     $response->assertInvalid();
    // }

    // public function failDatesProvider()
    // {
    //     return [
    //         'neither_present' => [
    //             null,
    //             null,
    //             false,
    //         ],
    //         'both_present' => [
    //             Carbon::now()->subDays(1),
    //             Carbon::now()->addDays(1),
    //             false,
    //         ],
    //         'last_date_present_correct' => [
    //             Carbon::now()->subDays(1),
    //             null,
    //             true,
    //         ],
    //         'next_date_present_correct' => [
    //             null,
    //             Carbon::now()->addDays(1),
    //             true,
    //         ],
    //         'last_date_present_incorrect' => [
    //             Carbon::now()->addDays(1),
    //             null,
    //             false,
    //         ],
    //         'next_date_present_incorrect' => [
    //             null,
    //             Carbon::now()->subDays(1),
    //             false,
    //         ],
    //     ];
    // }
}
