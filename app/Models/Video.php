<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Video extends Model
{
    protected $fillable = [
        'event', 'original', 'converted', 'thumb'
    ];

    protected $appends = ['files'];

    public static function list($event = null) {
        $result = Video::select(['id', 'event', 'converted', 'thumb']);

        if($event) {
            $result->where('event', $event);
        }

        return $result->paginate(20);
    }

    protected static function boot() {
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

    public function getFilesAttribute() {

        try {
            $thumb = File::where('id', $this->thumb)->firstOrFail()->toArray();
            $video = File::where('id', $this->converted)->firstOrFail()->toArray();
        } catch (ModelNotFoundException $e) {
            $thumb = $video = null;
        }

        return [
            'thumb' => $thumb,
            'video' => $video,
        ];
    }
}
