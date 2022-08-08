<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Resource model class
 *
 * @author Mariusz Waloszczyk
 */
class Resource extends Model
{
    use HasFactory;

    const ACTION_CREATE = 'create';

    const ACTION_UPDATE = 'update';

    const ACTION_DELETE = 'delete';

    const ACTION_VIEW_ANY = 'viewAny';

    const ACTION_VIEW = 'view';

    const RES_ROLES_OVERALL = 'res_roles_overall';

    const RES_MANUFACTURERS_OVERALL = 'res_manufacturers_overall';

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
     * Returns all possible actions for resources
     *
     * @author Mariusz Waloszczyk
     */
    public static function getPossibleActions(): array
    {
        return [
            self::ACTION_CREATE,
            self::ACTION_DELETE,
            self::ACTION_UPDATE,
            self::ACTION_VIEW,
            self::ACTION_VIEW_ANY,
        ];
    }
}
