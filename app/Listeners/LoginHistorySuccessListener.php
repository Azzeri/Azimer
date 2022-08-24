<?php

namespace App\Listeners;

use App\Actions\LoginHistory\StoreLoginAttemptAction;

/**
 * @author Piotr Nagórny
 */
class LoginHistorySuccessListener
{
    /**
     * Create the event listener.
     *
     * @author Piotr Nagórny
     */
    public function __construct(
        public StoreLoginAttemptAction $storeLoginAttemptAction
    ) {
    }

    /**
     * Handle the event.
     *
     * @author Piotr Nagórny
     */
    public function handle(object $event): void
    {
        $userId = $event->user->id;
        $this->storeLoginAttemptAction->execute($userId, true);
    }
}
