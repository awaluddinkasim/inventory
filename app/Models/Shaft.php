<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'img',
    ];
}
