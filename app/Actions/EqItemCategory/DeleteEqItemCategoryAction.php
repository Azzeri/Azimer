<?php

namespace App\Actions\EqItemCategory;

use App\Models\EqItemCategory;

/**
 * @author Piotr Nagórny
 */
class DeleteEqItemCategoryAction
{
    /**
     * Deletes Item Category in db
     *
     * @author Piotr Nagórny
     */
    public function execute(
        EqItemCategory $eqItemCategory
    ): bool|null {
        return $eqItemCategory->delete();
    }
}
