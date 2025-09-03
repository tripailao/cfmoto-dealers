<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dataset extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'vehicle_year',
        'type_data',
        'file_path',
    ];

    protected $dates =[
        'deleted_at'
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
