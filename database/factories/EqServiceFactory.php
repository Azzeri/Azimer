<?php

namespace Database\Factories;

use App\Services\EqItemService;
use App\Services\EqServiceTemplateService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model\EqService>
 *
 * @author Mariusz Waloszczyk
 */
class EqServiceFactory extends Factory
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
        $item = EqItemService::getRandomEqItem();
        $template = EqServiceTemplateService::getRandomEqServiceTemplate();

        return [
            'description' => fake()->paragraph(),
            'expected_perform_date' => fake()->date(),
            'eq_item_code' => $item->code,
            'eq_service_template_id' => $template->id,
        ];
    }

    /**
     * Inidicates service should be marked as finished
     *
     * @author Mariusz Waloszczyk
     */
    public function markedAsFinished()
    {
        return $this->state(function (array $attributes) {
            $user = UserService::getRandomUser();

            return [
                'actual_perform_date' => fake()->date(),
                'user_id' => $user->id,
            ];
        });
    }
}
