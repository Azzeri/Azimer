<?php

namespace Database\Factories;

use App\Services\EqItemService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EqFill>
 */
class EqFillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @author Mariusz Waloszczyk
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $eqItem = EqItemService::getRandomEqItem();
        $user = UserService::getRandomUser();
        $performDate = fake()->dateTime();

        return [
            'started_at' => $performDate,
            'finished_at' => Carbon::parse($performDate)->addMinutes(5),
            'eq_item_code' => $eqItem->code,
            'user_id' => $user->id,
        ];
    }
}
