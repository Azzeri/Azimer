<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Mariusz Waloszczyk
 */
class VehicleResource extends JsonResource
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
            'number' => $this->number,
            'name' => $this->name,
            'fire_brigade_unit' => new FireBrigadeUnitResource(
                $this->whenLoaded('fireBrigadeUnit')
            ),
        ];
    }
}
