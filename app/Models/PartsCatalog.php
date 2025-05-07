<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartsCatalog extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'vehicle',
        'vehicle_id',
        'title',
        'description',
        'file_path',
    ];
}
