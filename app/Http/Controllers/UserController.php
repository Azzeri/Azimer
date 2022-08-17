<?php

namespace App\Http\Controllers;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Resource;
use App\Models\User;
use App\Services\DropdownService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

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
        $this->authorize(
            Resource::ACTION_VIEW_ANY,
            User::class
        );

        $query = $this->getUsersQuery();

        $users = $query
            ->paginate()
            ->withQueryString();

        return inertia('User/Index', [
            'users' => $users,
            'fireBrigadeUnitSelect' => DropdownService::getFireBrigadeUnitsDropdown(),
        ])->table(function (InertiaTable $table) {
            $table
                ->column(
                    key: 'id',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'name',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'surname',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'email',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'phone',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'fire_brigade_unit_id',
                    label: 'Fire brigade unit',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    label: 'Actions'
                );
        });
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

    /**
     * Returns users list for index
     *
     * @author Mariusz Waloszczyk
     */
    private function getUsersQuery(): QueryBuilder
    {
        $query = QueryBuilder::for(User::class)
            ->select(
                'id',
                'name',
                'surname',
                'email',
                'phone',
                'fire_brigade_unit_id',
            )
            ->with(
                'fireBrigadeUnit:id,name'
            )
            ->allowedSorts([
                'id',
                'name',
                'surname',
                'email',
                'phone',
                'fire_brigade_unit_id',
            ])
            ->allowedFilters([
                'id',
                'name',
                'surname',
                'email',
                'phone',
                'fire_brigade_unit_id',
            ])
            ->defaultSort('id');

        return $this->appendQueryConditions($query);
    }

    /**
     * Adds conditions to query based on user resources
     *
     * @author Mariusz Waloszczyk
     */
    private function appendQueryConditions(
        QueryBuilder $query
    ): QueryBuilder {
        $auth = User::findOrFail(Auth::user()->id);

        if ($auth->hasResourceWithAction(
            Resource::RES_USERS_OVERALL,
            Resource::ACTION_VIEW_ANY
        )) {
            return $query;
        }

        if ($auth->hasResourceWithAction(
            Resource::RES_USERS_OWN_UNIT,
            Resource::ACTION_VIEW_ANY
        )) {
            $query->orWhere(
                'fire_brigade_unit_id',
                $auth->fire_brigade_unit_id
            );
        }

        // if ($auth->hasResourceWithAction(
        //     Resource::RES_USERS_LOWLY_UNITS,
        //     Resource::ACTION_VIEW_ANY
        // )) {
        //     $query->orWhere(
        //         'fireBrigadeUnit',
        //         $auth->fire_brigade_unit_id
        //     );
        // }

        return $query;
    }
}
