<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\File;
use App\Models\Video;
use FFMpeg\Coordinate\FrameRate;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ConvertVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;
    private $event;
    private $framerate = 5;
    private $boomerang = false;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\File $file    File to convert
     * @param \App\Models\Event $event  Event file belongs to
     * @param {Array} $params
     */
    public function __construct(File $file, Event $event, $params = null)
    {
        $this->file = $file;
        $this->event = $event;

        if($params) {
            $this->framerate = $params['framerate'] || $this->framerate;
            $this->boomerang = $params['boomerang'] || $this->boomerang;
        }
    }

    /**
     * Execute the job.
     *
     * @param \FFMPeg\FFMpeg $ffmpeg    Inject FFMpeg instance
     * @return void
     */
    public function handle(FFMpeg $ffmpeg) {
        $path = storage_path('app/'.$this->file->getFullPath());
        $folder = "public/video/{$this->event->getFolder()}";

        Storage::makeDirectory($folder, 0775);

        $video = $ffmpeg->open($path);

        $frame = $video->frame(TimeCode::fromSeconds(0));
        $thumbName = "thumb_{$this->file->name}.jpg";
        $frame->save(storage_path("app/{$folder}/$thumbName"));

        DB::transaction(function () use ($folder, $thumbName, &$video){
            $thumb = new File();
            $thumb->path = "{$folder}/$thumbName";
            $thumb->save();

            Video::where('file', $this->file->id)->update(['thumb' => $thumb->id]);

            $video
                ->filters()
                ->framerate(new FrameRate($this->framerate), 250)
                ->synchronize();

            $format = new X264();
            $format->setAdditionalParameters(['-filter_complex', '[0]reverse[r];[0][r] concat', '-an']);
            $format->on('progress', function ($video, $format, $percentage) {
                $this->file->progress = $percentage;
                $this->file->save();
            });

            $video->save($format, storage_path("app/{$folder}/conv_{$this->file->getFullName()}"));

            $this->file->progress = 100;
            $this->file->save();
        });
    }
}
