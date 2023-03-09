<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    const SUPER_ADMIN_ID = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'password',
        'fire_brigade_unit_id',
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
     * Scope a query to only include super admin
     */
    public function scopeSuperAdmin(Builder $query): void
    {
        $query->where('id', self::SUPER_ADMIN_ID);
    }

    /**
     * Returns all roles assigned to the user
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function roles()
    {
        return $this->belongsToMany(
            AclRole::class,
            'acl_role_user',
            'user_id',
            'role_suffix',
        );
    }

    /**
     * Returns unit to which user belongs
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function fireBrigadeUnit()
    {
        return $this->belongsTo(FireBrigadeUnit::class);
    }

    /**
     * Checks if user has the specified resource with the given action
     *
     * @author Mariusz Waloszczyk
     */
    public function hasResourceWithAction(
        string $resourceSuffix,
        string $action
    ): bool {
        foreach ($this->roles as $role) {
            foreach ($role->resources as $resource) {
                if (
                    $resource->suffix === $resourceSuffix
                    && $resource->pivot->action === $action
                ) {
                    return true;
                }
            }
        }

        return false;
    }
}
