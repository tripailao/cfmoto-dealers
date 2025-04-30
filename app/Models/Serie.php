<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Serie extends Model
{
    //
    use HasFactory;

    /**
     * Get the vehicle that owns the serie.
     */
    public function vehicle(): HasOne
    {
        return $this->hasOne(Vehicle::class);
    }

}
