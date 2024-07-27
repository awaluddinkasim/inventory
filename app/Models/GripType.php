<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GripType extends Model
{
    use HasFactory;

    protected $fillable = [
        'mfg',
        'name',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(GripModel::class);
    }
}
