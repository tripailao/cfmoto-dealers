<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
