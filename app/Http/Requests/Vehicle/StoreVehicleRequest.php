<?php

namespace App\Http\Requests\Vehicle;

use App\Models\Resource;
use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @author Piotr Nagórny 
     */
    public function authorize(): bool
    {
        return Gate::allows(Resource::ACTION_CREATE, Vehicle::class);
    }

    /**
     * Get the validation rules that apply to the request.
     * @author Piotr Nagónry
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'number' => [
                'required',
                'string',
                'max:64',
                'unique:vehicles,number',
            ],
            'name' => [
                'required',
                'string',
                'max:64',
            ],
        ];
    }
}
