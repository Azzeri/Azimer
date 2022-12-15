<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Mariusz Waloszczyk
 */
class EqServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @author Mariusz Waloszczyk
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'expected_perform_date' => $this->expected_perform_date,
            'actual_perform_date' => $this->actual_perform_date,
            'eq_service_template' => new EqServiceTemplateResource(
                $this->whenLoaded('eqServiceTemplate')
            ),
        ];
    }
}
