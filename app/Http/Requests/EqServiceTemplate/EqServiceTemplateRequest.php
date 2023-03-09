<?php

namespace App\Http\Requests\EqServiceTemplate;

use App\Http\Requests\BaseRequest;
use App\Models\EqServiceTemplate;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

/**
 * @author Mariusz Waloszczyk
 */
class EqServiceTemplateRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = EqServiceTemplate::class;
        $this->model = Request::route('eqServiceTemplate');
    }

    protected function getCommonValidationRules(): array
    {
        return [
            'description' => 'nullable|min:1|max:2048',
            'interval' => 'required|Integer|min:1|max:999',
        ];
    }

    protected function getStoreValidationRules(): array
    {
        return [
            'eq_item_template_id' => 'required|exists:eq_item_templates,id',
            'name' => 'required|max:64|unique:eq_service_templates',
        ];
    }

    protected function getUpdateValidationRules(): array
    {
        return [
            'name' => [
                'required',
                'max:64',
                Rule::unique('eq_service_templates')
                    ->ignore($this->eqServiceTemplate),
            ],
        ];
    }
}
