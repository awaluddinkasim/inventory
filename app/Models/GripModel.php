<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class GripModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
    ];

    public function grips(): HasMany
    {
        return $this->hasMany(Grip::class, 'model_id');
    }
}
