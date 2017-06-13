<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\File;
use FFMpeg\Coordinate\FrameRate;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class ConvertVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;
    private $event;
    private $params;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\File $file    File to convert
     * @param \App\Models\Event $event  Event file belongs to
     * @param {Array} $params
     *
     * @return void
     */
    public function __construct(File $file, Event $event, $params = null)
    {
        $this->file = $file;
        $this->event = $event;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @param \FFMPeg\FFMpeg $ffmpeg    Inject FFMpeg instance
     * @return void
     */
    public function handle(FFMpeg $ffmpeg) {
        $path = storage_path('app/'.$this->file->path);
        Storage::makeDirectory("public/video/{$this->event->getFolder()}");

        $framerate = $this->params && $this->params->framerate ? $this->params->framerate : 5;

        $video = $ffmpeg->open($path);
        $video
            ->filters()
            ->framerate(new FrameRate($framerate), 250)
            ->synchronize();

        $format = new X264();
        $format->setAdditionalParameters(['-filter_complex', '[0]reverse[r];[0][r] concat', '-an']);
        $format->on('progress', function ($video, $format, $percentage) {
            $this->file->progress = $percentage;
            $this->file->save();
        });

        $video->save($format, storage_path("app/public/video/{$this->event->getFolder()}/{$this->file->name}"));

        $this->file->progress = 100;
        $this->file->save();
    }
}
