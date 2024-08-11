<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grip extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'model_id',
        'size',
        'color',
        'weight',
        'core_size',
        'wholesale',
        'percent',
        'retail',
        'img',
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(GripModel::class, 'model_id');
    }

    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class, 'grip_id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(GripPurchase::class, 'grip_id');
    }

    public function retail(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->wholesale + ($this->wholesale * $this->percent / 100)
        );
    }

    public function sales(): HasMany
    {
        return $this->hasMany(GripSale::class, 'grip_id');
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->stock->sum('amount')
        );
    }
}
