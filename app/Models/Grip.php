<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grip extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'size_id',
        'color',
        'weight',
        'core_size',
        'wholesale',
        'percent'
    ];

    public function retail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->wholesale + ($this->wholesale * $this->percent)
        );
    }
}
