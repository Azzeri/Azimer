<?php

namespace App\Actions\EqItemTemplate;

use App\Models\EqItemTemplate;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteEqItemTemplateAction
{
    /**
     * Deletes template from db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        EqItemTemplate $eqItemTemplate
    ): bool|null {
        return $eqItemTemplate->delete();
    }
}
