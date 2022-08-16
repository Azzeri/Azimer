<?php

namespace App\Actions\User;

use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateUserAction
{
    public function __construct(
        public UserService $userService,
    ) {
    }

    /**
     * Updates user data
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request,
        User $user
    ): bool {
        $userRoles = $user->roles();
        $user->roles()->detach();

        try {
            $this->userService->attachRoles($user, $request->roles);
        } catch (Exception $e) {
            $user->roles()->detach();
            $user->roles()->attach($userRoles);
        }

        return $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'fire_brigade_unit_id' => $request->fire_brigade_unit_id,
        ]);
    }
}
