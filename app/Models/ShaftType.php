<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShaftType extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'name',
        'url',
    ];

    public function shafts(): HasMany
    {
        return $this->hasMany(Shaft::class, 'type_id');
    }
}
