<?php

namespace App\Http\Requests\EqService;

use App\Models\EqService;
use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;

/**
 * @author Mariusz Waloszczyk
 */
class EqServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @author Mariusz Waloszczyk
     */
    public function authorize(): bool
    {
        return Gate::allows(Resource::ACTION_UPDATE, EqService::class);
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
        return [];
    }
}
