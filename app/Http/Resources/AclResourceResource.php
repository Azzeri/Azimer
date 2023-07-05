<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @author Mariusz Waloszczyk
 */
class AclResourceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @author Mariusz Waloszczyk
     *
     */
    public function toArray($request): array|JsonSerializable
    {
        return [
            'suffix' => $this->suffix,
            'action' => $this->whenPivotLoaded(
                'acl_resource_role',
                function () {
                    return $this->pivot->action;
                }
            ),
        ];
    }
}
