<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShaftImage extends Model
{
    use HasFactory;

    protected $fillable = ['shaft_id', 'filename'];
}
