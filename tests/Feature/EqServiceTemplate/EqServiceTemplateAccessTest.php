<?php

namespace Tests\Feature\EqServiceTemplate;

use App\Models\EqServiceTemplate;
use App\Models\AclResource;
use App\Services\EqServiceTemplateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @author Mariusz Waloszczyk
 */
class EqServiceTemplateAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * @var EqServiceTemplateService
     */
    private $eqServiceTemplateService;

    public function setUp(): void
    {
        parent::setUp();

        $this->eqServiceTemplateService = new EqServiceTemplateService();
    }

    /**
     * Tests index access with different resources
     *
     * @dataProvider indexProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_index_access($forbidden, $resource)
    {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    AclResource::ACTION_VIEW,
                ],
            ],
        ]);
        $this->actingAs($auth);

        // Act
        $response = $this->get(
            route(
                'eqServiceTemplates.index',
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
            'success' => [
                false,
                AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            ],
            'forbidden' => [
                true,
                AclResource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests store access with different resources
     *
     * @dataProvider storeProvider
     *
     * @author Mariusz Waloszczyk
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
                    AclResource::ACTION_CREATE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $form = $this->eqServiceTemplateService->getSampleCorrectForm(true);

        // Act
        $response = $this->post(
            route('eqServiceTemplates.store'),
            $form
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
            'overall units' => [
                false,
                AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            ],
            'forbidden' => [
                true,
                AclResource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests update access with different resources
     *
     * @dataProvider updateProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_update_access(
        $forbidden,
        $resource,
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    AclResource::ACTION_UPDATE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $eqServiceTemplate = EqServiceTemplate::factory()->create();
        $form = $this->eqServiceTemplateService->getSampleCorrectForm(false);

        // Act
        $response = $this->put(
            route(
                'eqServiceTemplates.update',
                $eqServiceTemplate,
            ),
            $form
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertStatus(302);
        }
    }

    public function updateProvider()
    {
        return [
            'overall units' => [
                false,
                AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            ],
            'forbidden' => [
                true,
                AclResource::RES_DUMMY,
            ],
        ];
    }

    /**
     * Tests delete access with different resources
     *
     * @dataProvider deleteProvider
     *
     * @author Mariusz Waloszczyk
     */
    public function test_delete_access(
        $forbidden,
        $resource,
    ) {
        // Arrange
        $auth = $this->getUserWithResourcesAndActions([
            [
                'suffix' => $resource,
                'actions' => [
                    AclResource::ACTION_DELETE,
                ],
            ],
        ]);
        $this->actingAs($auth);

        $eqServiceTemplate = EqServiceTemplate::factory()->create();

        // Act
        $response = $this->delete(
            route(
                'eqServiceTemplates.destroy',
                $eqServiceTemplate
            ),
        );

        // Assert
        if ($forbidden) {
            $response->assertForbidden();
        } else {
            $response->assertStatus(302);
        }
    }

    public function deleteProvider()
    {
        return [
            'overall units' => [
                false,
                AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            ],
            'forbidden' => [
                true,
                AclResource::RES_DUMMY,
            ],
        ];
    }
}
