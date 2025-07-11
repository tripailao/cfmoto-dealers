<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dataset extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'vehicle_year',
        'type_data',
        'file_path',
    ];
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
