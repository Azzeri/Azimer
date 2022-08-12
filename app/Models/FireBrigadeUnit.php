<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Mariusz Waloszczyk
 */
class FireBrigadeUnit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'addr_street',
        'addr_number',
        'addr_postcode',
        'addr_locality',
        'superior_unit_id',
    ];

    /**
     * Returns unit superior unit
     * if exists
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function superiorFireBrigadeUnit()
    {
        return $this->belongsTo(
            FireBrigadeUnit::class,
            'superior_unit_id',
            'id'
        );
    }

    /**
     * Returns lowly units assigned to the unit
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function lowlyFireBrigadeUnits()
    {
        return $this->hasMany(
            FireBrigadeUnit::class,
            'superior_unit_id'
        );
    }

    /**
     * Returns all users assigned to unit
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
