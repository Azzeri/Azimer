<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemCategoryResource extends JsonResource
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
            'is_fillable' => $this->is_fillable,
            'parent_category' => new EqItemCategoryResource(
                $this->whenLoaded('parentCategory')
            ),
            'subcategories' => EqItemCategoryResource::collection(
                $this->whenLoaded('subcategories')
            ),
            'serviceTemplates' => EqServiceTemplateResource::collection(
                $this->whenLoaded('serviceTemplates')
            ),
        ];
    }
}
