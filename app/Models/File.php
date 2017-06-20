<?php

namespace App\Models;

use FFMpeg\FFProbe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

/**
 * @property string name
 * @property false|string path
 * @property int size
 * @property null|string mimetype
 * @property null|string resolution
 */
class File extends Model
{

    protected static function boot()
    {
        parent::boot();

        File::created(function ($file) {
            $ffprobe = App::make(FFProbe::class);

            try {
                $dimensions = $ffprobe->streams(storage_path('app/' . $file->path))->first()->getDimensions();
                $dimensions = "{$dimensions->getWidth()}x{$dimensions->getHeight()}";
            } catch (RuntimeException $e) {
                $dimensions = null;
            }

            $file->size = Storage::size($file->path);
            $file->mimetype = Storage::mimetype($file->path);
            $file->resolution = $dimensions;
            $file->save();
        });

        File::deleted(function ($file) {
            // TODO: delete file
            // Storage::delete($file->name);
        });
    }
}
