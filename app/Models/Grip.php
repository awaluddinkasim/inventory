<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Grip extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'size',
        'color',
        'weight',
        'core_size',
        'wholesale',
        'percent'
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(GripModel::class);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    public function retail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->wholesale + ($this->wholesale * $this->percent / 100)
        );
    }
}
