<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Role model class
 *
 * @author Mariusz Waloszczyk
 */
class Role extends Model
{
    use HasFactory;

    /** Default roles */
    const ROLE_ROLES_OVERALL = 'role_roles_overall';

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
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'suffix',
        'name',
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
            Resource::class,
            'resource_role',
            'role_suffix',
        )->withPivot(
            'actions'
        );
    }
}
