<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @property mixed event
 */
class Video extends Model
{
    protected $fillable = [
        'event', 'original', 'converted', 'thumb'
    ];

    protected $appends = ['files'];

    public static function list($event = null) {
        $result = Video::select(['id', 'event', 'converted', 'thumb', 'gif']);

        if($event) {
            $result->where('event', $event);
        }

        $result->whereNotNull('converted');

        return $result->paginate(40);
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
            $gif = File::where('id', $this->gif)->firstOrFail()->toArray();
        } catch (ModelNotFoundException $e) {
            $thumb = $video = $gif = null;
        }

        return [
            'thumb' => $thumb,
            'video' => $video,
            'gif' => $gif,
        ];
    }
}
