<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Piotr Nagórny
 */
class LoginHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'success',
        'date',
        'login_ip',
    ];
}
