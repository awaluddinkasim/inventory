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

    public function purchases(): HasMany
    {
        return $this->hasMany(GripPurchase::class, 'grip_id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(GripSale::class, 'grip_id');
    }

    public function stock(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->purchases->sum('quantity') - $this->sales->sum('quantity')
        );
    }

    public function purchasesAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->purchases->sum('amount')
        );
    }

    public function salesAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->sales->sum('amount')
        );
    }
}
