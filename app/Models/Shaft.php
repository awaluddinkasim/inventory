<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
