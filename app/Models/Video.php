<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'event', 'original', 'converted', 'thumb'
    ];

    protected static function boot()
    {
        parent::boot();

        Video::deleted(function ($video) {
            $columns = $video->getOriginal();
            $original = File::where('id', $columns['original'])->first();
            $original && $original->delete();
            $converted = File::where('id', $columns['converted'])->first();
            $converted && $converted->delete();
            $thumb = File::where('id', $columns['thumb'])->first();
            $thumb && $thumb->delete();
        });
    }
}
