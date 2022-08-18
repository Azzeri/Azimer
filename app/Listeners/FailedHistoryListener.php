<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;

/**
 * @author Piotr Nagórny
 */
class FailedHistoryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @author Piotr Nagórny
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->user == null) {
            return;
        } else {
            DB::table('login_histories')->insert([
                'user_id' => $event->user->id,
                'success' => false,
                'date' => now(),
                'login_ip' => request()->getClientIp(),
            ]);
        }
    }
}
