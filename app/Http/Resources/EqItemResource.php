<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'construction_number' => $this->construction_number,
            'inventory_number' => $this->inventory_number,
            'identification_number' => $this->identification_number,
            'date_expiry' => $this->date_expiry,
            'date_legalisation' => $this->date_legalisation,
            'date_legalisation_due' => $this->date_legalisation_due,
            'date_production' => $this->date_production,
            'eq_item_template' => new EqItemTemplateResource(
                $this->whenLoaded('eqItemTemplate')
            ),
            'vehicle' => new VehicleResource(
                $this->whenLoaded('vehicle')
            ),
            'fire_brigade_unit' => new FireBrigadeUnitResource(
                $this->whenLoaded('fireBrigadeUnit')
            ),
            'services' => EqServiceResource::collection(
                $this->whenLoaded('eqItemServices')
            ),
        ];
    }
}
