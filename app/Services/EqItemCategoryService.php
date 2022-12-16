<?php

namespace App\Services;

use App\Helpers\DataTableRow;
use App\Http\Resources\DateTableRowResource;
use App\Http\Resources\EqItemCategoryResource;
use App\Models\EqItemCategory;

/**
 * @author Piotr Nagórny
 */
class EqItemCategoryService
{
    /**
     * Returns users list for index
     *
     * @author Mariusz Waloszczyk
     */
    public function getCategoriesQuery()
    {
        $dataTableService = new DataTableService(
            [
                new DataTableRow('id', 'ID', searchable: false),
                new DataTableRow('name', 'name'),
                new DataTableRow('parent_category_id', 'Parent category', searchable: false),
                new DataTableRow('is_fillable', 'fillable', searchable: false),
                new DataTableRow('actions', 'actions', searchable: false, sortable: false),
            ]
        );

        $query = $dataTableService->prepareQuery(
            EqItemCategory::class,
            [
                'parentCategory',
                'subcategories',
                'serviceTemplates',
            ],
        );

        $query = $dataTableService->getResults($query);

        return EqItemCategoryResource::collection($query)
            ->additional([
                'columns' => DateTableRowResource::collection(
                    $dataTableService->getFields()
                ),
            ]);
    }

    /**
     * Returns form that will pass validation
     *
     * @author Piotr Nagórny
     */
    public function getCorrectForm(): array
    {
        $parentCategory = EqItemCategory::factory()->create();

        return [
            'name' => 'test category',
            'is_fillable' => true,
            'parent_category_id' => $parentCategory->id,
        ];
    }

    /**
     * Returns random eq item category or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomEqItemCategory(): EqItemCategory
    {
        $category = EqItemCategory::inRandomOrder()->first();

        if (is_null($category)) {
            return EqItemCategory::factory()
                ->create();
        }

        return $category;
    }
}
