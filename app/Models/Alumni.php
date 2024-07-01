<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'batch',
        'email',
        'address'
        // Add other fillable attributes here if any
    ];
}
