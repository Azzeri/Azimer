<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Role model class
 *
 * @author Mariusz Waloszczyk
 */
class AclRole extends Model
{
    use HasFactory;

    /** Default roles */
    const ROLE_SUPER_ADMIN = 'role_super_admin';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'suffix';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'suffix',
    ];

    /**
     * Returns all resources assigned to the role
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function resources()
    {
        return $this->belongsToMany(
            AclResource::class,
            'acl_resource_role',
            'role_suffix',
            'resource_suffix'
        )->withPivot(
            'action'
        );
    }

    /**
     * Returns all users assigned to the role
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}