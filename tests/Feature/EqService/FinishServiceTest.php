<?php

namespace Tests\Feature\EqItem;

use App\Models\EqService;
use App\Models\AclResource;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class FinishServiceTest extends TestCase
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
                    AclResource::ACTION_UPDATE,
                ],
            ],
        ]);

        $this->actingAs($auth);
    }

    /**
     * Case: Mark service as finished and create new one
     *
     * @author Mariusz Waloszczyk
     */
    public function test_mark_service_as_finished(): void
    {
        // Arrange
        $eqService = EqService::factory()
            ->create([
                'expected_perform_date' => Carbon::now()
                    ->subDays(1)
                    ->format('Y-m-d'),
            ]);
        $template = $eqService->eqServiceTemplate;

        // Act
        $response = $this->put(
            route(
                'eqServices.finish',
                $eqService
            ),
            []
        );

        // Assert
        $response->assertValid();

        // $this->assertSame(
        //     Carbon::now()->format('Y-m-d'),
        //     $eqService->actual_perform_date
        // );

        $this->assertDatabaseHas('eq_services', [
            'expected_perform_date' => Carbon::parse($eqService->actual_perform_date)
                ->addDays($template->interval)
                ->format('Y-m-d'),
        ]);
    }
}
