<?php

namespace App\Http\Requests\FireBrigadeUnit;

use App\Models\FireBrigadeUnit;
use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * @author Mariusz Waloszczyk
 */
class StoreFireBrigadeUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @author Mariusz Waloszczyk
     */
    public function authorize(): bool
    {
        return Gate::allows(
            Resource::ACTION_CREATE,
            FireBrigadeUnit::class
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @author Mariusz Waloszczyk
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'unique:fire_brigade_units|required|string|max:128',
            'addr_street' => 'required|string|max:128',
            'addr_number' => 'required|string|max:16',
            'addr_locality' => 'required|string|max:128',
            'addr_postcode' => ['required', 'string', 'max:6'],
            'superior_unit_id' => 'nullable|exists:fire_brigade_units,id',
        ];
    }
}
