<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Mariusz Waloszczyk
 */
class EqService extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'description',
        'expected_perform_date',
        'actual_perform_date',
        'eq_item_code',
        'eq_service_template_id',
        'user_id',
    ];

    /**
     * Returns service template to which service belongs
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function eqServiceTemplate()
    {
        return $this->belongsTo(EqServiceTemplate::class);
    }

    /**
     * Returns user who peformed the service
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns item on which service was performed
     * {@inheritdoc}
     *
     * @author Mariusz Waloszczyk
     */
    public function eqItem()
    {
        return $this->belongsTo(
            EqItem::class,
            'eq_item_code',
            'code'
        );
    }
}
