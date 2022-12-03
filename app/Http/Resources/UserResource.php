<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Mariusz Waloszczyk
 */
class UserResource extends JsonResource
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
            'surname' => $this->surname,
            'email' => $this->email,
            'phone' => $this->phone,
            'roles' => RoleResource::collection(
                $this->whenLoaded('roles')
            ),
            'fire_brigade_unit' => new FireBrigadeUnitResource(
                $this->whenLoaded('fireBrigadeUnit')
            ),
        ];
    }
}
