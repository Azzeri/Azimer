<?php

namespace App\Services;

use App\Http\Resources\EqServiceTemplateResource;
use App\Models\EqServiceTemplate;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\DB;

/**
 * Equipment Item Templates services class
 *
 * @author Mariusz Waloszczyk
 */
class EqServiceTemplateService
{
    /**
     * Gets service templates list for given category and manufacturer
     *
     * @author Mariusz Waloszczyk
     *
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getTemplateServices(
        string $manufacturerId,
        string $eqItemCategoryId
    ) {
        $eqServiceTemplates = DB::table('eq_service_templates')
            ->leftJoin('eq_services', 'eq_services.eq_service_template_id', '=', 'eq_service_templates.id')
            ->select('*', 'eq_service_templates.description', 'eq_service_templates.id')
            ->where('eq_item_category_id', $eqItemCategoryId)
            ->where('manufacturer_id', $manufacturerId)
            ->whereNull('eq_services.id')
            ->get();

        return EqServiceTemplateResource::collection($eqServiceTemplates);
    }

    /**
     * Returns form that will pass validation
     *
     * @author Mariusz Waloszczyk
     */
    public function getSampleCorrectForm(
        bool $withStoreParams
    ): array {
        $template = EqItemTemplateService::getRandomEqItemTemplate();

        $commonParameters = [
            'name' => 'T1234',
            'description' => 'Lorem ipsum sit...',
            'interval' => 24,
        ];

        $storeParameters = [
            'eq_item_template_id' => $template->id,
        ];

        return $withStoreParams
            ? $commonParameters + $storeParameters
            : $commonParameters;
    }

    /**
     * Returns random service template or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomEqServiceTemplate(): EqServiceTemplate
    {
        $template = EqServiceTemplate::inRandomOrder()->first();

        if (is_null($template)) {
            return EqServiceTemplate::factory()
                ->create();
        }

        return $template;
    }
}
