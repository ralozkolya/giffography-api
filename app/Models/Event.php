<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $fillable = [
        'ka_name', 'en_name', 'folder', 'date', 'parent', 'thumb'
    ];

    protected $appends = ['thumbnail'];

    protected static function boot() {
        parent::boot();

        Event::creating(function ($event) {
            if(!$event->date) {
                $event->date = Carbon::now()->format('Y-m-d');
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
            Storage::deleteDirectory('public/'.$event->getFolder());
        });
    }

    public function getFolder() {
        $path = str_replace('-', '/', $this->date);
        return $path . '/' . $this->id;
    }

    public function getThumbnailAttribute() {

        try {
            $thumb = File::where('id', $this->thumb)->firstOrFail()->toArray();
        } catch (ModelNotFoundException $e) {
            $thumb = null;
        }

        return $thumb;
    }
}
