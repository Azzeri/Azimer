<?php

namespace App\Http\Requests\Role;

use App\Models\AclResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows(AclResource::ACTION_UPDATE, $this->role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'suffix' => 'exists:roles,suffix',
            'newSuffix' => [
                'required',
                'min:3',
                'max:64',
                'alpha_dash',
                'starts_with:role_',
                Rule::unique('roles', 'suffix')
                    ->ignore($this->role, 'suffix'),
            ],
            'name' => [
                'required',
                'min:3',
                'max:64',
                'unique:roles',
            ],
            'resources' => 'required|array',
            'resources.*' => 'required|array:suffix,actions',
            'resources.*.suffix' => 'required|exists:resources,suffix|distinct',
            'resources.*.actions' => [
                'required',
                'array',
                Rule::in([
                    AclResource::ACTION_CREATE,
                    AclResource::ACTION_DELETE,
                    AclResource::ACTION_UPDATE,
                    AclResource::ACTION_VIEW,
                    AclResource::ACTION_VIEW,
                ]),
                'max:5', //remove if unique actions implemented
            ],
        ];
    }
}
