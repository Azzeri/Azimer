<?php

namespace App\Listeners;

use App\Actions\LoginHistory\StoreLoginAttemptAction;

/**
 * @author Piotr Nagórny
 */
class LoginHistoryListener
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
    }

    /**
     * Handle the event.
     *
     * @author Piotr Nagórny
     */
    public function handle(object $event): void
    {
        $userid = $event->user->id;
        $this->log->execute($userid, true);
    }
}
