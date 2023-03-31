<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function touristAttraction()
    {
        return $this->hasMany(TouristAttraction::class);
    }
}
