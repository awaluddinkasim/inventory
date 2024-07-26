<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GripSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function grips(): HasOne
    {
        return $this->hasOne(Grip::class, 'size_id');
    }
}
