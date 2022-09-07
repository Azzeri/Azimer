<?php

namespace App\Actions\EqServiceTemplate;

use App\Models\EqServiceTemplate;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteEqServiceTemplateAction
{
    /**
     * Deletes template from db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        EqServiceTemplate $eqServiceTemplate
    ): bool|null {
        return $eqServiceTemplate->delete();
    }
}
