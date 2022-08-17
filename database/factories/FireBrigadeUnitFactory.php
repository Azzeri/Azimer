<?php

namespace Database\Factories;

use App\Models\FireBrigadeUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FireBrigadeUnit>
 *
 * @author Mariusz Waloszczyk
 */
class FireBrigadeUnitFactory extends Factory
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
        return [
            'name' => fake()
                ->unique()
                ->numerify('Fire Brigade Unit - ####'),
            'addr_street' => fake()->streetName(),
            'addr_number' => fake()->buildingNumber(),
            'addr_postcode' => fake()->numerify('48-###'),
            'addr_locality' => fake()->city(),
        ];
    }

    /**
     * Inidicates unit should have superior unit
     *
     * @author Mariusz Waloszczyk
     */
    public function withSuperiorUnit()
    {
        return $this->state(function (array $attributes) {
            $parentUnit = FireBrigadeUnit::factory()->create();

            return [
                'superior_unit_id' => $parentUnit->id,
            ];
        });
    }
}
