<?php

namespace App\Services;

use App\Models\EqItem;

/**
 * @author Piotr Nagórny
 */
class EqUsageService
{
    /**
     * Returns form that will pass validation
     *
     * @author Piotr Nagórny
     */
    public function getCorrectForm(): array
    {
        $eqItem = EqItem::factory()->create();

        return [
            'description' => 'test description',
            'usage_start' => '2077-04-20',
            'usage_end' => '2077-04-21',
            'eq_item_code' => $eqItem->code,
        ];
    }
}
