<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristAttraction extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'ta_name',
        'ta_desc',
        'ta_facilities',
        'id_tourism_category',
        'id_picture'
    ];
    public function tourismCategory()
    {
        return $this->belongsTo(TourismCategory::class, 'id_tourism_category');
    }

    public function picture()
    {
        return $this->hasMany(Picture::class, 'id_picture');
    }
}
