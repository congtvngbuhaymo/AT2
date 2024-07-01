<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employ extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'batch',
        'employed',
        'position',
        'department'
        // Add other fillable attributes here if any
    ];
}
