<?php

namespace App\Services;

use App\Helpers\DataTableRow;
use App\Http\Resources\DateTableRowResource;
use App\Http\Resources\EqItemTemplateResource;
use App\Models\EqItemTemplate;

/**
 * Equipment Item Templates services class
 *
 * @author Mariusz Waloszczyk
 */
class EqItemTemplateService
{
    /**
     * Returns templates list for index
     *
     * @author Mariusz Waloszczyk
     */
    public function getEqItemTemplatesQuery()
    {
        $dataTableService = new DataTableService(
            [
                new DataTableRow('id', 'ID', searchable: false),
                new DataTableRow('eq_item_category_id', 'Category', searchable: false),
                new DataTableRow('manufacturer_id', 'Manufacturer', searchable: false),
                new DataTableRow('actions', 'actions', searchable: false, sortable: false),
            ]
        );

        $query = $dataTableService->prepareQuery(
            EqItemTemplate::class,
            [
                'eqItemCategory',
                'manufacturer',
            ],
        );

        $query = $dataTableService->getResults($query);

        return EqItemTemplateResource::collection($query)
            ->additional([
                'columns' => DateTableRowResource::collection(
                    $dataTableService->getFields()
                ),
            ]);
    }

    /**
     * Returns random eq item template or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomEqItemTemplate(): EqItemTemplate
    {
        $template = EqItemTemplate::inRandomOrder()->first();

        if (is_null($template)) {
            return EqItemTemplate::factory()
                ->create();
        }

        return $template;
    }

    /**
     * Returns form that will pass validation
     *
     * @author Mariusz Waloszczyk
     */
    public function getSampleCorrectForm(): array
    {
        $eqItemCategory = EqItemCategoryService::getRandomEqItemCategory();
        $manufacturer = ManufacturerService::getRandomManufacturer();

        return [
            'name' => 'test template',
            'eq_item_category_id' => $eqItemCategory->id,
            'manufacturer_id' => $manufacturer->id,
            'has_vehicle' => true,
            'has_construction_number' => true,
            'has_inventory_number' => true,
            'has_identification_number' => true,
            'has_date_expiry' => true,
            'has_date_legalisation' => true,
            'has_date_legalisation_due' => true,
            'has_date_production' => true,
        ];
    }
}
