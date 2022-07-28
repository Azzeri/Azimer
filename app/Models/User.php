<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * User model class
 *
 * @author Mariusz Waloszczyk
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Returns all roles assigned to the user
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',
            'user_id',
            'role_suffix',
        );
    }

    /**
     * Checks if user has specified resource with actions
     *
     * @author Mariusz Waloszczyk
     */
    public function hasResourceWithAction(
        string $resource_suffix,
        string $action
    ): bool {
        foreach ($this->roles as $role) {
            foreach ($role->resources as $resource) {
                if (
                    $resource->suffix === $resource_suffix &&
                    in_array($action, json_decode($resource->pivot->actions))
                ) {
                    return true;
                }
            }
        }

        return false;
    }
}
