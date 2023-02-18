<?php

namespace App\Http\Requests\Role;

use App\Models\AclResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * @author Mariusz Waloszczyk
 */
class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @author Mariusz Waloszczyk
     */
    public function authorize(): bool
    {
        return Gate::allows(AclResource::ACTION_CREATE, Role::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'suffix' => [
                'required',
                'min:3',
                'max:64',
                'alpha_dash',
                'unique:roles',
                'starts_with:role_',
            ],
            'name' => [
                'required',
                'min:3',
                'max:64',
                'unique:roles',
            ],
        ];
    }
}
