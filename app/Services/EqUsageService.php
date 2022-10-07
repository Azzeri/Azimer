<?php

namespace App\Services;

use App\Models\EqItem;
use App\Models\User;

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
        $eqItemCode = EqItem::factory()->create();
        $user_id = User::factory()->create();

        return [
            'description' => 'test description',
            'executed_at' => '2077-04-20',
            'duration_minutes' => 50,
            'eq_item_code' => $eqItemCode->code,
            'user_id' => $user_id->id,
        ];
    }
}
