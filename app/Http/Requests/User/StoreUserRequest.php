<?php

namespace App\Http\Requests\User;

use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * @author Mariusz Waloszczyk
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @author Mariusz Waloszczyk
     */
    public function authorize(): bool
    {
        return Gate::allows(Resource::ACTION_CREATE, User::class);
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
            'name' => 'required|string|max:64',
            'surname' => 'required|string|max:64',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|unique:users|email:filter',
            'fire_brigade_unit_id' => 'nullable|exists:fire_brigade_units',
        ];
    }
}
