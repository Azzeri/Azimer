<?php

namespace App\Http\Requests\EqItemTemplate;

use App\Http\Requests\BaseRequest;
use App\Models\EqItemTemplate;
use Illuminate\Support\Facades\Request;

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
            'has_name' => 'required|boolean',
            'has_construction_number' => 'required|boolean',
            'has_inventory_number' => 'required|boolean',
            'has_identification_number' => 'required|boolean',
            'has_date_production' => 'required|boolean',
            'has_date_expiry' => 'required|boolean',
            'has_date_legalisation' => 'required|boolean',
            'has_date_legalisation_due' => 'required|boolean',
            'has_vehicle' => 'required|boolean',
            'is_fillable' => 'required|boolean',
        ];
    }
}
