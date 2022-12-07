<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

/**
 * @author Mariusz Waloszczyk
 */
class UserRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = User::class;
        $this->model = Request::route('user');
    }

    protected function getCommonValidationRules(): array
    {
        return [
            'name' => 'required|string|max:64',
            'surname' => 'required|string|max:64',
            'phone' => 'nullable|string|max:20',
            'fire_brigade_unit_id' => 'nullable|exists:fire_brigade_units,id',
        ];
    }

    protected function getStoreValidationRules(): array
    {
        return [
            'email' => 'required|unique:users|email:filter',
        ];
    }

    protected function getUpdateValidationRules(): array
    {
        return [
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
