<?php

namespace Database\Factories;

use App\Services\EqItemService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EqItemCategory>
 *
 * @author Piotr Nagórny
 */
class EqUsageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @author Piotr Nagórny
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $eqItem = EqItemService::getRandomEqItem();
        $user = UserService::getRandomUser();

        return [
            'description' => fake()->sentence(),
            'executed_at' => fake()->dateTime(),
            'duration_minutes' => fake()->randomNumber(),
            'eq_item_code' => $eqItem->code,
            'user_id' => $user->id,
        ];
    }
}
