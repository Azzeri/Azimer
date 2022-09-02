<?php

namespace App\Services;

use App\Models\EqItemTemplate;

/**
 * Equipment Item Templates services class
 *
 * @author Mariusz Waloszczyk
 */
class EqItemTemplateService
{
    /**
     * Returns random eq item template or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomEqItemTemplate(): EqItemTemplate
    {
        $template = EqItemTemplate::inRandomOrder()->first();

        if (is_null($template)) {
            return EqItemTemplate::factory()
                ->create();
        }

        return $template;
    }
}
