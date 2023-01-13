<?php

namespace App\Http\Requests\EqItem;

use App\Http\Requests\BaseRequest;
use App\Models\EqItem;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = EqItem::class;
        $this->model = Request::route('eqItem');
    }

    protected function getCommonValidationRules(): array
    {
        return [
            'fire_brigade_unit_id' => 'required|exists:fire_brigade_units,id',
            'vehicle_number' => 'nullable|exists:eq_item_templates,id',
            'construction_number' => 'nullable|string',
            'inventory_number' => 'nullable|string',
            'identification_number' => 'nullable|string',
            'date_expiry' => 'nullable|date',
            'date_legalisation' => 'nullable|date',
            'date_legalisation_due' => 'nullable|date',
            'date_production' => 'nullable|date',
        ];
    }

    protected function getStoreValidationRules(): array
    {
        return [
            'code' => 'required|max:255|unique:eq_items',
            'name' => 'max:128|unique:eq_items',
            'eq_item_template_id' => 'required|exists:eq_item_templates,id',
        ];
    }

    protected function getUpdateValidationRules(): array
    {
        return [
            'code' => [
                'required',
                'max:255',
                Rule::unique('eq_items')
                    ->ignore($this->eqItem),
            ],
            'name' => [
                'max:128',
                Rule::unique('eq_items')
                    ->ignore($this->eqItem),
            ],
        ];
    }
}
