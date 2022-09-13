<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Mariusz Waloszczyk
 */
class EqServiceTemplate extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'interval',
        'eq_item_category_id',
        'manufacturer_id',
    ];

    /**
     * Returns item category to which service template belongs
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function eqItemCategory()
    {
        //
    }

    /**
     * Returns manufacturer to which service template belongs
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
