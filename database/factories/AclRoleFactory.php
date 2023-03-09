<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AclRole>
 *
 * @author Mariusz Waloszczyk
 */
class AclRoleFactory extends Factory
{
    private const SUFFIX = 'role_';

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
            'suffix' => self::SUFFIX.fake()->unique()->randomNumber(5, true),
        ];
    }
}
