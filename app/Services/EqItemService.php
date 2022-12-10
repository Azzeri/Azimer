<?php

namespace App\Services;

use App\Helpers\DataTableRow;
use App\Http\Resources\DateTableRowResource;
use App\Http\Resources\EqItemResource;
use App\Models\EqItem;
use App\Models\EqItemTemplate;
use App\Models\FireBrigadeUnit;
use App\Models\Vehicle;

/**
 * Equipment Item Templates services class
 *
 * @author Mariusz Waloszczyk
 */
class EqItemService
{
    /**
     * Returns eqItems list for index
     *
     * @author Mariusz Waloszczyk
     */
    public function getEqItems()
    {
        $dataTableService = new DataTableService(
            [
                new DataTableRow('code', 'code'),
                new DataTableRow('eq_item_template_id', 'template', searchable: false),
                new DataTableRow('fire_brigade_unit_id', 'fire brigade unit', searchable: false),
                new DataTableRow('actions', 'actions', searchable: false, sortable: false),
            ]
        );

        $query = $dataTableService->prepareQuery(
            EqItem::class,
            [
                'eqItemTemplate',
                'fireBrigadeUnit',
            ],
        );

        $query = $dataTableService->getResults($query);

        return EqItemResource::collection($query)
            ->additional([
                'columns' => DateTableRowResource::collection(
                    $dataTableService->getFields()
                ),
            ]);
    }

    /**
     * Returns form that will pass validation
     *
     * @author Mariusz Waloszczyk
     */
    public function getSampleCorrectForm(): array
    {
        $template = EqItemTemplate::factory()->create();
        $unit = FireBrigadeUnit::factory()->create();
        $vehicle = Vehicle::factory()->create();

        return [
            'code' => 'C1234',
            'name' => 'testName',
            'eq_item_template_id' => $template->id,
            'fire_brigade_unit_id' => $unit->id,
            'vehicle_number' => $vehicle->id,
            'construction_number' => '1234',
            'inventory_number' => '1234',
            'identification_number' => '1234',
            'date_expiry' => '2010-10-10',
            'date_legalisation' => '2010-10-10',
            'date_legalisation_due' => '2010-10-10',
            'date_production' => '2010-10-10',
        ];
    }

    /**
     * Returns random eq item or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomEqItem(): EqItem
    {
        $item = EqItem::inRandomOrder()->first();

        if (is_null($item)) {
            return EqItem::factory()
                ->create();
        }

        return $item;
    }
}
