<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Under extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'batch',
        'email',
        'address'
        // Add other fillable attributes here if any
    ];
}
