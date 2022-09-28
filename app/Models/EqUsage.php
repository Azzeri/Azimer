<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Piotr Nagórny
 */
class EqUsage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'description',
        'executed_at',
        'duration_minutes',
        'eq_item_code',
        'user_id',
    ];
}
