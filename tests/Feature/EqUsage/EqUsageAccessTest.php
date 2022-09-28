<?php

namespace Tests\Feature\EqUsage;

use App\Models\Resource;
use App\Services\EqUsageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Piotr Nagórny
 */
class EqUsageAccessTest extends TestCase
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
    }

    /**
     * Tests index access with different resources
     *
     * @dataProvider indexProvider
     *
     * @author Piotr Nagórny
     */
    public function test_index_access($forbidden, $resource)
    {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_VIEW_ANY,
                ],
            ],
        ]);
        $this->actingAs($auth);

        // Act
        $response = $this->get(
            route(
                'eqUsages.index',
            )
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertOk();
        }
    }

    public function indexProvider()
    {
        return [
            'overall Usage' => [
                false,
                Resource::RES_EQ_USAGES,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests store access with different resources
     *
     * @dataProvider storeProvider
     *
     * @author Piotr Nagórny
     */
    public function test_store_access(
        $forbidden,
        $resource,
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    Resource::ACTION_CREATE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $form = $this->eqUsageService->getCorrectForm();

        // Act
        $response = $this->post(
            route('eqUsages.store'),
            $form,
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertStatus(302);
        }
    }

    public function storeProvider()
    {
        return [
            'overall Usage' => [
                false,
                Resource::RES_EQ_USAGES,
            ],
            'forbidden' => [
                true,
                Resource::RES_DUMMY,
            ],
        ];
    }
}
