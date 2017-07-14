<?php

namespace App\Models;

use FFMpeg\FFProbe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

/**
 * @property string name
 * @property string path
 * @property string extension
 * @property int size
 * @property null|string mimetype
 * @property null|string resolution
 * @property number id
 */
class File extends Model {

    protected $appends = ['full_path'];

    protected static function boot() {
        parent::boot();

        File::created(function ($file) {
            $ffprobe = App::make(FFProbe::class);

            try {
                $path = storage_path('app/'.$file->path);
                $dimensions = $ffprobe->streams($path)->first()->getDimensions();
                $dimensions = "{$dimensions->getWidth()}x{$dimensions->getHeight()}";
            } catch (RuntimeException $e) {
                $dimensions = null;
            }

            $file->size = Storage::size($file->path);
            $file->mimetype = Storage::mimetype($file->path);
            $file->resolution = $dimensions;

            $file->extension = \Illuminate\Support\Facades\File::extension($file->path);
            $file->name = \Illuminate\Support\Facades\File::name($file->path);
            $file->path = \Illuminate\Support\Facades\File::dirname($file->path);

            $file->save();
        });

        File::deleted(function ($file) {
            Storage::delete($file->getLocalPathAttribute());
        });
    }

    public function getFullPathAttribute() {
        return asset($this->local_path);
    }

    public function getLocalPathAttribute() {
        return $this->path.'/'.$this->full_name;
    }

    public function getFullNameAttribute() {
        return $this->name.'.'.$this->extension;
    }

    public function getDimensionsArrayAttribute() {
        return explode('x', $this->resolution);
    }
}
