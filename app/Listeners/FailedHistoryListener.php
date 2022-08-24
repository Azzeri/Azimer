<?php

namespace App\Listeners;

use App\Actions\LoginHistory\StoreLoginAttemptAction;

/**
 * @author Piotr Nagórny
 */
class FailedHistoryListener
{
    /**
     * Create the event listener.
     *
     * @author Piotr Nagórny
     *
     * @return void
     */
    public function __construct(public StoreLoginAttemptAction $log)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @author Piotr Nagórny
     *
     * @param  object  $event
     */
    public function handle($event): void
    {
        if ($event->user == null) {
            return;
        }
        $userid = $event->user->id;
        $this->log->execute($userid, false);
    }
}
