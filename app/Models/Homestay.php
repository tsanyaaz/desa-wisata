<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }
}
