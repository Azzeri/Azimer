<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Piotr Nagórny
 */
class Vehicle extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'number';

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

    protected $fillable = [
        'number',
        'name',
        'fire_brigade_unit_id',
    ];

    /**
     * Returns unit to which vehicle belongs
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function fireBrigadeUnit()
    {
        return $this->belongsTo(FireBrigadeUnit::class);
    }
}
