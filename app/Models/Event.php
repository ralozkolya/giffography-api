<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'folder', 'date', 'parent', 'thumb'
    ];

    protected static function boot() {
        parent::boot();

        Event::creating(function ($event) {
            if(!$event->date) {
                $event->date = Carbon::now();
            }
        });

        Event::deleting(function ($event) {

            $events = Event::where('parent', $event->id)->get();
            foreach($events as $e) {
                $e->delete();
            }

            $videos = Video::where('event', $event->id)->get();
            foreach($videos as $v) {
                $v->delete();
            }
        });

        Event::deleted(function ($event) {
            $thumb = File::where('id', $event->thumb)->first();
            $thumb && $thumb->delete();
        });
    }

    public function getFolder() {
        $path = str_replace('-', '/', $this->date);
        return $path . '/' . $this->id;
    }
}
