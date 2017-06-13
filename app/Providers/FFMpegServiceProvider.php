<?php

namespace App\Providers;

use FFMpeg\FFMpeg;
use Illuminate\Support\ServiceProvider;

class FFMpegServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $params = ['ffmpeg.threads' => 2];

        $ffmpeg_path = env('FFMPEG_PATH');
        $ffprobe_path = env('FFPROBE_PATH');

        if($ffmpeg_path && $ffprobe_path) {
            $params['ffmpeg.binaries'] = $ffmpeg_path;
            $params['ffprobe.binaries'] = $ffprobe_path;
        }

        $this->app->singleton(FFMpeg::class, function ($app) use ($params) {
            return FFMpeg::create($params);
        });
    }

    public function provides() {
        return [FFMpeg::class];
    }
}
