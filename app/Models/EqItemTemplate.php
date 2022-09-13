<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemTemplate extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name',
        'eq_item_category_id',
        'manufacturer_id',
        'has_vehicle',
        'has_construction_number',
        'has_inventory_number',
        'has_identification_number',
        'has_date_expiry',
        'has_date_legalisation',
        'has_date_legalisation_due',
        'has_date_production',
    ];

    /**
     * Returns manufacturer
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function manufacturer()
    {
        return $this->belongsTo(
            Manufacturer::class,
        );
    }
}
