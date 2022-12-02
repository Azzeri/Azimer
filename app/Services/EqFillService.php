<?php

namespace App\Services;

use App\Models\EqItem;

/**
 * @author Mariusz Waloszczyk
 */
class EqFillService
{
    /**
     * Returns form that will pass validation
     *
     * @author Mariusz Waloszczyk
     */
    public function getCorrectForm(): array
    {
        $eqItem = EqItem::factory()->create();

        return [
            'started_at' => '2022-10-10 07:05:00',
            'finished_at' => '2022-10-10 07:07:00',
            'eq_item_code' => $eqItem->code,
        ];
    }
}
