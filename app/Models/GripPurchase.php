<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GripPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'grip_id',
        'wholesale',
        'quantity',
        'date',
    ];

    public function grip(): BelongsTo
    {
        return $this->belongsTo(Grip::class, 'grip_id');
    }
}
