<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Piotr Nagórny
 */
class EqItemCategory extends Model
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
        'photo_path',
        'is_fillable',
        'parent_category_id',
    ];

    /**
     * Returns parent categories
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function parentCategory()
    {
        return $this->belongsTo(
            EqItemCategory::class,
        );
    }

    /**
     * Returns subcategories
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function subcategories()
    {
        return $this->hasMany(
            EqItemCategory::class,
            'parent_category_id'
        );
    }
}
