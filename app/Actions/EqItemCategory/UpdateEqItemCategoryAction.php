<?php

namespace App\Actions\EqItemCategory;

use App\Models\EqItemCategory;
use Illuminate\Http\Request;

/**
 * @author Piotr Nagórny
 */
class UpdateEqItemCategoryAction
{
    /**
     * Update Item Category in db
     *
     * @author Piotr Nagórny
     */
    public function execute(
        Request $request,
        EqItemCategory $eqItemCategory,
    ): bool {
        return $eqItemCategory->update([
            'name' => $request->name,
            'parent_category_id' => $request->parent_category_id,
            'photo_path' => $request->photo_path,
        ]);
    }
}
