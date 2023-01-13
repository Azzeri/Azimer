<?php

namespace App\Http\Requests\EqFill;

use App\Http\Requests\BaseRequest;
use App\Models\EqFill;
use Illuminate\Support\Facades\Request;

/**
 * @author Mariusz Waloszczyk
 */
class EqFillRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = EqFill::class;
        $this->model = Request::route('eqFill');
    }

    /**
     * {@inheritdoc}
     */
    protected function getCommonValidationRules(): array
    {
        // dd($this->request);
        return [
            'started_at' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d H:i:s')],
            'finished_at' => 'required|date|after:started_at',
            'eq_item_code' => 'exists:eq_items,code',
        ];
    }
}
