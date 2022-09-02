<?php

namespace App\Http\Requests\EqItemTemplate;

use App\Http\Requests\BaseRequest;
use App\Models\EqItemTemplate;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemTemplateRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = EqItemTemplate::class;
        $this->model = Request::route('eqItemTemplate');
    }

    protected function getCommonValidationRules(): array
    {
        return [
            'eq_item_category_id' => 'required|exists:eq_item_categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'has_vehicle' => 'required|boolean',
            'has_construction_number' => 'required|boolean',
            'has_inventory_number' => 'required|boolean',
            'has_identification_number' => 'required|boolean',
            'has_date_expiry' => 'required|boolean',
            'has_date_legalisation' => 'required|boolean',
            'has_date_legalisation_due' => 'required|boolean',
            'has_date_production' => 'required|boolean',
        ];
    }

    protected function getStoreValidationRules(): array
    {
        return [
            'name' => 'required|max:64|unique:eq_item_templates',
        ];
    }

    protected function getUpdateValidationRules(): array
    {
        return [
            'name' => [
                'required',
                'max:64',
                Rule::unique('eq_item_templates')
                    ->ignore($this->eqItemTemplate),
            ],
        ];
    }
}
