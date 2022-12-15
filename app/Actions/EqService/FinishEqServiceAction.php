<?php

namespace App\Actions\EqService;

use App\Models\EqService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * @author Mariusz Waloszczyk
 */
class FinishEqServiceAction
{
    /**
     * Marks service as finished and creates the next one
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        EqService $eqService,
    ): EqService {
        $eqService->update([
            'actual_perform_date' => Carbon::now()->format('Y-m-d'),
            'user_id' => Auth::user()->id,
        ]);

        $serviceTemplate = $eqService->eqServiceTemplate;

        return EqService::create([
            'expected_perform_date' => Carbon::parse($eqService->actual_perform_date)
                ->addDays($serviceTemplate->interval),
            'eq_item_code' => $eqService->eqItem->code,
            'eq_service_template_id' => $serviceTemplate->id,
        ]);
    }
}
