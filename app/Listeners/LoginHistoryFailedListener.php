<?php

namespace App\Listeners;

use App\Actions\LoginHistory\StoreLoginAttemptAction;

/**
 * @author Piotr Nagórny
 */
class LoginHistoryFailedListener
{
    /**
     * Create the event listener.
     *
     * @author Piotr Nagórny
     */
    public function __construct(public StoreLoginAttemptAction $storeLoginAttemptAction)
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
        $userId = $event->user->id;
        $this->storeLoginAttemptAction->execute($userId, false);
    }
}
