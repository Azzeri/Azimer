<?php

namespace App\Actions\EqItem;

use App\Models\EqItem;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteEqItemAction
{
    /**
     * Deletes item from db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        EqItem $eqItem
    ): bool|null {
        return $eqItem->delete();
    }
}
