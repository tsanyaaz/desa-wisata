<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'imageable_id',
        'imageable_type'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public static function store($file, $directory, $model, $singular = false)
    {
        $newName = $model->id . '_' . $file->getClientOriginalName();

        while (Picture::where('path', $newName)->exists()) {
            $newName = $model->id . '_' . $file->getClientOriginalName();
        }

        $file->move(storage_path('app/public/' . $directory), $newName);

        if ($singular) {
            if ($model->picture) {
                Picture::purge($model->picture);
            }
            $model->picture()->create(['path' => 'storage/' . $directory . '/' . $newName]);
        } else {
            $model->pictures()->create(['path' => 'storage/' . $directory . '/' . $newName]);
        }
    }

    public static function purge($picture)
    {
        Storage::delete('public/' . $picture->path);
        $picture->delete();
    }
}
