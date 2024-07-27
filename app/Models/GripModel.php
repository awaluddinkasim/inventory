<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class GripModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'name',
        'url',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(GripType::class);
    }

    public function grips(): HasMany
    {
        return $this->hasMany(Grip::class);
    }
}
