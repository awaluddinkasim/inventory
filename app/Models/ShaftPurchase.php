<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShaftPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'shaft_id',
        'wholesale',
        'quantity',
        'date',
    ];

    public function shaft(): BelongsTo
    {
        return $this->belongsTo(Shaft::class, 'shaft_id');
    }
}
