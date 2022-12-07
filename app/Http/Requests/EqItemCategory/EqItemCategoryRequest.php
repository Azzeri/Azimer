<?php

namespace App\Http\Requests\EqItemCategory;

use App\Http\Requests\BaseRequest;
use App\Models\EqItemCategory;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

/**
 * @author Piotr Nagórny
 */
class EqItemCategoryRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = EqItemCategory::class;
        $this->model = Request::route('eqItemCategory');
    }

    protected function getCommonValidationRules(): array
    {
        return [
            'is_fillable' => 'boolean',
        ];
    }

    protected function getStoreValidationRules(): array
    {
        return [
            'name' => 'unique:eq_item_categories|required|string|max:64',
            'parent_category_id' => 'nullable|exists:eq_item_categories,id',
        ];
    }

    protected function getUpdateValidationRules(): array
    {
        return [
            'name' => [
                Rule::unique('eq_item_categories')
                    ->ignore($this->eqItemCategory),
                'required',
                'string',
                'max:64',
            ],
            'parent_category_id' => [
                'nullable',
                'exists:eq_item_categories,id',
                Rule::notIn($this->eqItemCategory->id),
            ],
        ];
    }
}
