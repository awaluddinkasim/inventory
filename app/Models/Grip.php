<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function images(): HasMany
    {
        return $this->hasMany(GripImage::class, 'grip_id');
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

    public function lastPurchase(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->purchases->sortByDesc('date')->first() ? Carbon::parse($this->purchases->sortByDesc('date')->first()->date)->isoFormat('DD MMMM YYYY') : '-'
        );
    }

    public function purchasesAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->purchases->sum('amount')
        );
    }

    public function lastSale(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->sales->sortByDesc('date')->first() ? Carbon::parse($this->sales->sortByDesc('date')->first()->date)->isoFormat('DD MMMM YYYY') : '-'
        );
    }

    public function salesAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->sales->sum('amount')
        );
    }
}
