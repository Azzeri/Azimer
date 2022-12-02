<?php

namespace App\Http\Requests\EqUsage;

use App\Http\Requests\BaseRequest;
use App\Models\EqUsage;
use Illuminate\Support\Facades\Request;

/**
 * @author Piotr Nagórny
 */
class EqUsageRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = EqUsage::class;
        $this->model = Request::route('eqUsage');
    }

    /**
     * {@inheritdoc}
     */
    protected function getCommonValidationRules(): array
    {
        return [
            'description' => 'string|max:255|nullable',
            'executed_at' => 'required|date',
            'duration_minutes' => 'required|integer',
            'eq_item_code' => 'exists:eq_items,code',
        ];
    }
}
