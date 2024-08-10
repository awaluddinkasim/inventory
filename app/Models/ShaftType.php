<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShaftType extends Model
{
    use HasFactory;

    protected $fillable = [
        'mfg',
        'name',
        'url',
    ];
}
