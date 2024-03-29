<?php

namespace App\Http\Requests\Manufacturer;

use App\Models\Manufacturer;
use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreManufacturerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @author Piotr Nagórny
     */
    public function authorize(): bool
    {
        return Gate::allows(Resource::ACTION_CREATE, Manufacturer::class);
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
            'name' => [
                'required',
                'string',
                'max:64',
            ],
        ];
    }
}
