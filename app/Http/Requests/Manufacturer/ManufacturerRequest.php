<?php

namespace App\Http\Requests\Manufacturer;

use App\Http\Requests\BaseRequest;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Request;

/**
 * @author Mariusz Waloszczyk
 */
class ManufacturerRequest extends BaseRequest
{
    public function __construct()
    {
        $this->class = Manufacturer::class;
        $this->model = Request::route('manufacturer');
    }

    protected function getCommonValidationRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:64',
            ],
        ];
    }
}
