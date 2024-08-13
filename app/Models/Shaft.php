<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function images(): HasMany
    {
        return $this->hasMany(ShaftImage::class, 'shaft_id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(ShaftPurchase::class, 'shaft_id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(ShaftSale::class, 'shaft_id');
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
