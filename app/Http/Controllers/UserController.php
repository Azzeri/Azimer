<?php

namespace App\Http\Controllers;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\User\UserRequest;
use App\Models\AclResource;
use App\Models\User;
use App\Services\DataTableService;
use App\Services\DropdownService;
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
    public function index(
        UserRequest $userRequest
    ) {
        $users = $this->userService->getUsersQuery();

        return inertia('User/Index', [
            'users' => $users,
            'fireBrigadeUnitSelect' => DropdownService::getFireBrigadeUnitsDropdown(),
            'filters' => DataTableService::getFilters(),
        ]);
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
        UserRequest $userRequest,
        StoreUserAction $storeUserAction
    ) {
        $randomPassword = $this->userService
            ->generateRandomPassword();

        $user = $storeUserAction->execute(
            $userRequest,
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
        UserRequest $userRequest,
        UpdateUserAction $updateUserAction,
        User $user
    ) {
        $updateUserAction->execute(
            $userRequest,
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
        UserRequest $userRequest,
        User $user,
        DeleteUserAction $deleteUserAction
    ) {
        if (! $this->userService->canUserBeDeleted($user)) {
            $deleteUserAction->execute($user);
        }

        return redirect()->route('users.index');
    }

    // /**
    //  * Adds conditions to query based on user resources
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // private function appendQueryConditions(
    //     QueryBuilder $query
    // ): QueryBuilder {
    //     $auth = User::findOrFail(Auth::user()->id);

    //     if ($auth->hasResourceWithAction(
    //         AclResource::RES_OVERALL_USERS,
    //         AclResource::ACTION_VIEW
    //     )) {
    //         return $query;
    //     }

    //     if ($auth->hasResourceWithAction(
    //         AclResource::RES_OWN_UNIT_FIRE_BRIGADE_UNIT,
    //         AclResource::ACTION_VIEW
    //     )) {
    //         $query->orWhere(
    //             'fire_brigade_unit_id',
    //             $auth->fire_brigade_unit_id
    //         );
    //     }

    //     // if ($auth->hasResourceWithAction(
    //     //     AclResource::RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT,
    //     //     AclResource::ACTION_VIEW
    //     // )) {
    //     //     $query->orWhere(
    //     //         'fireBrigadeUnit',
    //     //         $auth->fire_brigade_unit_id
    //     //     );
    //     // }

    //     return $query;
    // }
}
