<?php

namespace App\Http\Controllers;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Resource;
use App\Models\User;
use App\Services\UserService;

/**
 * @author Mariusz Waloszczyk
 */
class UserController extends Controller
{
    public function __construct(
        public UserService $userService,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Http\Response
     */
    public function store(
        StoreUserRequest $request,
        StoreUserAction $storeUserAction
    ) {
        $randomPassword = $this->userService
            ->generateRandomPassword();

        $user = $storeUserAction->execute(
            $request,
            $randomPassword
        );

        $this->userService->sendWelcomeEmail(
            $user->email,
            $randomPassword
        );

        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdateUserRequest $request,
        UpdateUserAction $updateUserAction,
        User $user
    ) {
        $updateUserAction->execute(
            $request,
            $user
        );

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        User $user,
        DeleteUserAction $deleteUserAction
    ) {
        $this->authorize(
            Resource::ACTION_DELETE,
            $user,
            User::class
        );

        if (! $this->userService->canUserBeDeleted($user)) {
            $deleteUserAction->execute($user);
        }

        return redirect()->route('users.index');
    }
}
