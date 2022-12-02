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
            'executed_at' => '2077-04-20',
            'duration_minutes' => 50,
            'eq_item_code' => $eqItem->code,
        ];
    }
}
