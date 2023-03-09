<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Resource model class
 *
 * @author Mariusz Waloszczyk
 */
class AclResource extends Model
{
    use HasFactory;

    /** Actions */
    public const ACTION_VIEW_ANY = 'view_any';

    public const ACTION_VIEW = 'view';

    public const ACTION_CREATE = 'create';

    public const ACTION_UPDATE = 'update';

    public const ACTION_DELETE = 'delete';

    /** Resources */
    public const RES_DUMMY = 'res_dummy';

    public const RES_OVERALL_USERS = 'res_overall_users';

    public const RES_OVERALL_FIRE_BRIGADE_UNITS = 'res_overall_fire_brigade_units';

    public const RES_OVERALL_EQUIPMENT_RESOURCES = 'res_overall_equipment_resources';

    public const RES_OVERALL_EQUIPMENT = 'res_overall_equipment';

    public const RES_OWN_UNIT_USERS = 'res_own_unit_users';

    public const RES_OWN_UNIT_FIRE_BRIGADE_UNIT = 'res_own_unit_fire_brigade_unit';

    public const RES_OWN_UNIT_EQUIPMENT = 'res_own_unit_equipment';

    public const RES_LOWLY_UNITS_USERS = 'res_lowly_units_users';

    public const RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT = 'res_lowly_units_fire_brigade_unit';

    public const RES_LOWLY_UNITS_EQUIPMENT = 'res_lowly_units_equipment';

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
     * Returns all possible actions for resources
     *
     * @author Mariusz Waloszczyk
     */
    public static function getPossibleActions(): array
    {
        return [
            self::ACTION_VIEW_ANY,
            self::ACTION_VIEW,
            self::ACTION_CREATE,
            self::ACTION_UPDATE,
            self::ACTION_DELETE,
        ];
    }
}
