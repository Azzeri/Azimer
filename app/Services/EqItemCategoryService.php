<?php

namespace App\Services;

use App\Models\EqItemCategory;

/**
 * @author Piotr Nagórny
 */
class EqItemCategoryService
{
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
}
