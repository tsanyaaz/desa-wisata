<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristAttraction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tourismCategory()
    {
        return $this->belongsTo(TourismCategory::class, 'id_tourism_category');
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }
}
