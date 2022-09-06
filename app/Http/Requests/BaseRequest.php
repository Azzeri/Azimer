<?php

namespace App\Http\Requests;

use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;

/**
 * @author Mariusz Waloszczyk
 */
class BaseRequest extends FormRequest
{
    protected string $class;

    protected mixed $model;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @author Mariusz Waloszczyk
     */
    public function authorize(): bool
    {
        return match ($this->method()) {
            $this::METHOD_GET => $this->accessForView(),
            $this::METHOD_POST => $this->accessForCreate(),
            $this::METHOD_PUT, $this::METHOD_PATCH => $this->accessForUpdate(),
            $this::METHOD_DELETE => $this->accessForDelete(),
        };
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @author Mariusz Waloszczyk
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case $this::METHOD_POST:
                $rules =
                    $this->getCommonValidationRules() +
                    $this->getStoreValidationRules();
                break;
            case $this::METHOD_PUT:
            case $this::METHOD_PATCH:
                $rules =
                    $this->getCommonValidationRules() +
                    $this->getUpdateValidationRules();
                break;
            default:
                $rules = [];
        }

        return $rules;
    }

    /**
     * Determines access via GET method
     * checking if action is index or show
     *
     * @author Mariusz Waloszczyk
     */
    private function accessForView()
    {
        if ($this->model) {
            return Gate::allows(
                Resource::ACTION_VIEW,
                $this->model,
                $this->class
            );
        }

        return Gate::allows(
            Resource::ACTION_VIEW_ANY,
            $this->class
        );
    }

    /**
     * Determines access via POST method
     *
     * @author Mariusz Waloszczyk
     */
    private function accessForCreate()
    {
        return Gate::allows(
            Resource::ACTION_CREATE,
            $this->class
        );
    }

    /**
     * Determines access via PUT/PATCH method
     *
     * @author Mariusz Waloszczyk
     */
    private function accessForUpdate()
    {
        return Gate::allows(
            Resource::ACTION_UPDATE,
            $this->model,
            $this->class
        );
    }

    /**
     * Determines access via DELETE method
     *
     * @author Mariusz Waloszczyk
     */
    private function accessForDelete()
    {
        return Gate::allows(
            Resource::ACTION_DELETE,
            $this->model,
            $this->class
        );
    }

    /**
     * Gets validation rules common for store and update
     *
     * @author Mariusz Waloszczyk
     */
    protected function getCommonValidationRules(): array
    {
        return [];
    }

    /**
     * Gets validation rules specific for store
     *
     * @author Mariusz Waloszczyk
     */
    protected function getStoreValidationRules(): array
    {
        return [];
    }

    /**
     * Gets validation rules specific for update
     *
     * @author Mariusz Waloszczyk
     */
    protected function getUpdateValidationRules(): array
    {
        return [];
    }
}
