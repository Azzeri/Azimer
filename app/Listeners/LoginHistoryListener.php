<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;

/**
 * @author Piotr Nagórny
 */
class LoginHistoryListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        DB::table('login_histories')->insert([
            'user_id' => $event->user->id,
            'success' => true,
            'date' => now(),
            'login_ip' => request()->getClientIp(),
        ]);
    }
}
