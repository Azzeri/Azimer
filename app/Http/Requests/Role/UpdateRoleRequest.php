<?php

namespace App\Http\Requests\Role;

use App\Models\Resource;
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
        return Gate::allows(Resource::ACTION_UPDATE, $this->role);
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
                    Resource::ACTION_CREATE,
                    Resource::ACTION_DELETE,
                    Resource::ACTION_UPDATE,
                    Resource::ACTION_VIEW,
                    Resource::ACTION_VIEW_ANY,
                ]),
                'max:5', //remove if unique actions implemented
            ],
        ];
    }
}
