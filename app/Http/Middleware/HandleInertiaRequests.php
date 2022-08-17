<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'authenticatedUserRoles' => [
                $this->getAuthenticatedUserRoles(),
            ],
            'flash' => [
                'message' => fn () => $request
                    ->session()
                    ->get('message'),
            ],
        ]);
    }

    /**
     * Returns authenticated user roles
     *
     * @return Illuminate\Database\Eloquent\Collection
     *
     * @author Mariusz Waloszczyk
     */
    private function getAuthenticatedUserRoles()
    {
        if (! Auth::user()) {
            return;
        }

        $user = User::findOrFail(Auth::user()->id)
            ->with(
                'roles:suffix',
                'roles.resources:suffix'
            )
            ->first();

        return $user->roles;
    }
}
