<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

        File::deleted(function ($file) {
            // TODO: delete file
            // Storage::delete($file->name);
        });
    }
}
