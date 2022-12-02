<?php

namespace App\Http\Controllers;

use App\Actions\EqService\FinishEqServiceAction;
use App\Http\Requests\EqService\EqServiceRequest;
use App\Models\EqService;
use Illuminate\Http\RedirectResponse;

class EqServiceController extends Controller
{
    public function finish(
        EqServiceRequest $request,
        EqService $eqService,
        FinishEqServiceAction $finishEqServiceAction
    ): RedirectResponse {
        $finishEqServiceAction->execute($eqService);

        return redirect()
            ->back()
            ->with('message', 'Sukces');
    }
}
