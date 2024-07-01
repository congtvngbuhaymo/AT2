<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unemploy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'batch'

        // Add other fillable attributes here if any
    ];
}
