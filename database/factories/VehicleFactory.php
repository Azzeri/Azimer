<?php

namespace Database\Factories;

use App\Services\FireBrigadeUnitService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 *
 * @author Piotr Nagórny
 */
class VehicleFactory extends Factory
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
        $unit = FireBrigadeUnitService::getRandomFireBrigadeUnit();

        return [
            'number' => fake()->unique()->numerify('Veh-####'),
            'name' => fake()->name(),
            'fire_brigade_unit_id' => $unit->id,
        ];
    }
}
