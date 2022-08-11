<?php

namespace App\Http\Requests\Vehicle;

use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @author Piotr Nagórny
     */
    public function authorize(): bool
    {
        return Gate::allows(Resource::ACTION_UPDATE, $this->vehicle);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @author Piotr Nagórny
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'number' => [
                'required',
                'string',
                'max:64',
                Rule::unique('vehicles', 'number')
                    ->ignore($this->vehicle, 'number'),
            ],
            'name' => [
                'required',
                'string',
                'max:64',
            ],
        ];
    }
}
