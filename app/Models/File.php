<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
