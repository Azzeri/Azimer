<?php

namespace App\Actions\EqItemCategory;

use App\Models\EqItemCategory;
use Illuminate\Http\Request;

/**
 * @author Piotr Nagórny
 */
class StoreEqItemCategoryAction
{
    /**
     * Stores Item Category in db
     *
     * @author Piotr Nagórny
     */
    public function execute(
        Request $request
    ): EqItemCategory {
        return EqItemCategory::create([
            'name' => $request->name,
            'is_fillable' => $request->is_fillable,
            'parent_category_id' => $request->parent_category_id,
        ]);
    }
}
