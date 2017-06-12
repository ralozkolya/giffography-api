<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'folder', 'date', 'parent', 'thumb'
    ];

    protected static function boot()
    {
        parent::boot();

        Event::creating(function ($event) {
            if(!$event->date) {
                $event->date = Carbon::now();
            }
        });

        Event::deleting(function ($event) {
            Video::where('event', $event->id)->delete();
        });

        Event::deleted(function ($event) {
            File::where('id', $event->thumb)->delete();
        });
    }
}
