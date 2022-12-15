<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Mariusz Waloszczyk
 */
class EqItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'name',
        'eq_item_template_id',
        'fire_brigade_unit_id',
        'vehicle_number',
        'construction_number',
        'inventory_number',
        'identification_number',
        'date_expiry',
        'date_legalisation',
        'date_legalisation_due',
        'date_production',
    ];

    /**
     * Returns unit to which item belongs
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function fireBrigadeUnit()
    {
        return $this->belongsTo(FireBrigadeUnit::class);
    }

    /**
     * Returns item template to which item belongs
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function eqItemTemplate()
    {
        return $this->belongsTo(EqItemTemplate::class);
    }

    /**
     * Returns vehicle to which item belongs
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function vehicle()
    {
        return $this->belongsTo(
            Vehicle::class,
            'vehicle_number',
            'number'
        );
    }

    /**
     * Returns all services associated with item
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function eqItemServices()
    {
        return $this->hasMany(
            EqService::class,
            'eq_item_code',
            'code'
        );
    }
}
