<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristAttraction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['image_path'];

    public function tourismCategory()
    {
        return $this->belongsTo(TourismCategory::class, 'id_tourism_category');
    }

    public function getImagePathAttribute()
    {
        return $this->pictures->first()->path;
    }

    public function pictures()
    {
        return $this->morphMany(Picture::class, 'imageable');
    }
}
