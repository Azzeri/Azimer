<?php

namespace App\Services;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class for returning lists of models, which can be used
 * for example in select fields
 *
 * @author Mariusz Waloszczyk
 */
class DropdownService
{
    /**
     * Get resources list prepared for select field
     *
     * @author Mariusz Waloszczyk
     */
    public function getResourcesDropdown(): Collection
    {
        return Resource::select('suffix')->get();
    }
}
