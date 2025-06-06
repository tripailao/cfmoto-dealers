<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'serie_name',
        'serie_id',
        'year',
        'image_path',
    ];

    /**
     * Get the serie associated with the vehicle.
     */
    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

}
