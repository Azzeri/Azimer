<?php

namespace App\Actions\User;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @author Mariusz Waloszczyk
 */
class StoreUserAction
{
    public function __construct(
        public UserService $userService,
    ) {
    }

    /**
     * Stores user in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request,
        string $password
    ): User {
        return User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($password),
            'fire_brigade_unit_id' => $request->fire_brigade_unit_id,
        ]);
    }
}
