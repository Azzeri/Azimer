<?php

namespace App\Actions\LoginHistory;

use App\Models\LoginHistory;
use Jenssegers\Agent\Agent;

/**
 * @author Piotr Nagórny
 */
class StoreLoginAttemptAction
{
    /**
     * @author Piotr Nagórny
     */
    public function execute(int $userId, bool $isSuccess)
    {
        $agent = new Agent();
        LoginHistory::create([
            'user_id' => $userId,
            'is_success' => $isSuccess,
            'date' => now(),
            'login_ip' => request()->getClientIp(),
            'browser' => $agent->browser(),
        ]);
    }
}
