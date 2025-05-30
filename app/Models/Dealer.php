<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'address',
        'phone',
    ];
}
