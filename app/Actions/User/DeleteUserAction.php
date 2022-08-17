<?php

namespace App\Actions\User;

use App\Models\User;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteUserAction
{
    /**
     * Soft deletes user from db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        User $user
    ): bool|null {
        return $user->delete();
    }
}
