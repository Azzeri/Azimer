<?php

namespace App\Http\Requests\FireBrigadeUnit;

use App\Http\Requests\BaseRequest;
use App\Models\FireBrigadeUnit;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

/**
 * @author Mariusz Waloszczyk
 */
class FireBrigadeUnitRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = FireBrigadeUnit::class;
        $this->model = Request::route('fireBrigadeUnit');
    }

    protected function getCommonValidationRules(): array
    {
        return [
            'addr_street' => 'required|string|max:128',
            'addr_number' => 'required|string|max:16',
            'addr_locality' => 'required|string|max:128',
            'addr_postcode' => 'required|string|max:6',
        ];
    }

    protected function getStoreValidationRules(): array
    {
        return [
            'name' => 'unique:fire_brigade_units|required|string|max:128',
            'superior_unit_id' => 'nullable|exists:fire_brigade_units,id',
        ];
    }

    protected function getUpdateValidationRules(): array
    {
        return [
            'name' => [
                Rule::unique('fire_brigade_units')
                    ->ignore($this->fireBrigadeUnit),
                'required',
                'string',
                'max:128',
            ],
            'superior_unit_id' => [
                'nullable',
                'exists:fire_brigade_units,id',
                Rule::notIn($this->fireBrigadeUnit->id),
            ],
        ];
    }
}
