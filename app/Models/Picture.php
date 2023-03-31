<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
    ];

    public function homestays()
    {
        return $this->hasMany(Homestay::class);
    }

    public function touristAttractions()
    {
        return $this->hasMany(TouristAttraction::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
