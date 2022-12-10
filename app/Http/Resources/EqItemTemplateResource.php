<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemTemplateResource extends JsonResource
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
            'name' => $this->name,
            'has_vehicle' => $this->has_vehicle,
            'has_construction_number' => $this->has_construction_number,
            'has_inventory_number' => $this->has_inventory_number,
            'has_identification_number' => $this->has_identification_number,
            'has_date_expiry' => $this->has_date_expiry,
            'has_date_legalisation' => $this->has_date_legalisation,
            'has_date_legalisation_due' => $this->has_date_legalisation_due,
            'has_date_production' => $this->has_date_production,
            'eq_item_category' => new EqItemCategoryResource(
                $this->whenLoaded('eqItemCategory')
            ),
            'manufacturer' => new ManufacturerResource(
                $this->whenLoaded('manufacturer')
            ),
        ];
    }
}
