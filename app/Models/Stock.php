<?php

namespace App\Models;

use Carbon\Carbon;
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
        return $this->belongsTo(Grip::class);
    }

    public function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->isoFormat('DD MMMM YYYY')
        );
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->quantity * $this->grip->wholesale
        );
    }
}
