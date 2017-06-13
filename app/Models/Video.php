<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'event', 'file', 'thumb'
    ];

    protected static function boot()
    {
        parent::boot();

        Video::deleted(function ($video) {
            $file = File::where('id', $video->file)->first();
            $file && $file->delete();
            $thumb = File::where('id', $video->thumb)->first();
            $thumb && $thumb->delete();
        });
    }
}
