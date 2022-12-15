<?php

namespace App\Http\Requests\EqItem;

use App\Models\EqItem;
use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;

class EqItemActivateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @author Mariusz Waloszczyk
     */
    public function authorize(): bool
    {
        return Gate::allows(
            Resource::ACTION_UPDATE,
            $this->eqItem,
            EqItem::class
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @author Mariusz Waloszczyk
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'eq_service_template_id' => 'required|exists:eq_service_templates,id',
            'last_service_date' => [
                'nullable',
                // 'required_if:next_service_date,null',
                // 'prohibited_unless:next_service_date,null',
                'before_or_equal:today',
                'date',
            ],
            'next_service_date' => [
                'nullable',
                // 'required_if:last_service_date,null',
                // 'prohibited_unless:last_service_date,null',
                'after_or_equal:today',
                'date',
            ],
        ];
    }
}
