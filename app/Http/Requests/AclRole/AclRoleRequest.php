<?php

namespace App\Http\Requests\AclRole;

use App\Http\Requests\BaseRequest;
use App\Models\AclRole;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

/**
 * @author Mariusz Waloszczyk
 */
class AclRoleRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = AclRole::class;
        $this->model = Request::route('aclRole');
    }

    protected function getCommonValidationRules(): array
    {
        return [
            'aclResources' => 'array',
        ];
    }

    protected function getStoreValidationRules(): array
    {
        return [
            'suffix' => 'required|max:64|unique:acl_roles|alpha_dash|starts_with:role_',
        ];
    }

    protected function getUpdateValidationRules(): array
    {
        return [
            'suffix' => [
                'required',
                'max:64',
                'alpha_dash',
                'starts_with:role_',
                Rule::unique('acl_roles')->ignore($this->aclRole),
            ],
        ];
    }
}
