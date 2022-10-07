<?php

namespace Database\Factories;

use App\Models\EqItem;
use App\Models\User;
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
        $eqItemCode = EqItem::factory()->create();
        $user_id = User::factory()->create();

        return [
            'description' => fake()->sentence(),
            'executed_at' => fake()->dateTime(),
            'duration_minutes' => fake()->randomNumber(),
            'eq_item_code' => $eqItemCode->code,
            'user_id' => $user_id->id,
        ];
    }
}
