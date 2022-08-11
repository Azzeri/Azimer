<?php

namespace App\Http\Requests\User;

use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @author Mariusz Waloszczyk
     */
    public function authorize(): bool
    {
        return Gate::allows(Resource::ACTION_UPDATE, $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:64',
            'surname' => 'required|string|max:64',
            'phone' => 'nullable|string|max:20',
            'email' => [
                'required',
                'email:filter',
                Rule::unique('users')->ignore($this->user),
            ],
            'roles' => 'required|array',
            'roles.*' => 'required|array:suffix',
            'roles.*.suffix' => 'required|exists:roles,suffix|distinct',
        ];
    }
}
