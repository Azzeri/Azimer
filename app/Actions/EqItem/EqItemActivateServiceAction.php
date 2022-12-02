<?php

namespace App\Actions\EqItem;

use App\Models\EqItem;
use App\Models\EqService;
use App\Models\EqServiceTemplate;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemActivateServiceAction
{
    /**
     * Creates service for given item and template
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request,
        EqItem $eqItem
    ): EqService {
        $serviceTemplate = EqServiceTemplate::findOrFail(
            $request->eq_service_template_id
        );

        $expectedPerformDate = $request->next_service_date
            ?: Carbon::parse($request->last_service_date)->addDays($serviceTemplate->interval);

        return EqService::create([
            'description' => $request->description,
            'expected_perform_date' => $expectedPerformDate,
            'eq_item_code' => $eqItem->code,
            'eq_service_template_id' => $serviceTemplate->id,
        ]);
    }
}
