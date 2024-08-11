<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shaft extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type_id',
        'shaft',
        'flex',
        'length',
        'weight',
        'wholesale',
        'percent',
        'retail',
        'img',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ShaftType::class);
    }

    public function retail(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->wholesale + ($this->wholesale * $this->percent / 100)
        );
    }
}
