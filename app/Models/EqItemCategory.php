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

    protected $fillable = [
        'name',
        'photo_path',
        'is_fillable',
        'parent_category_id',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
