<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'grip_id',
        'quantity',
        'date',
    ];

    public function grip(): BelongsTo
    {
        return $this->belongsTo(Grip::class, 'grip_id');
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->quantity * $this->grip->wholesale
        );
    }
}
