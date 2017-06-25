<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'event', 'original', 'conveted', 'thumb'
    ];

    protected static function boot()
    {
        parent::boot();

        Video::deleted(function ($video) {
            $original = File::where('id', $video->original)->first();
            $original && $original->delete();
            $converted = File::where('id', $video->converted)->first();
            $converted && $converted->delete();
            $thumb = File::where('id', $video->thumb)->first();
            $thumb && $thumb->delete();
        });
    }
}
