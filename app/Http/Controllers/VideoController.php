<?php

namespace App\Http\Controllers;

use App\Jobs\ConvertVideo;
use App\Models\Event;
use App\Models\File;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Video::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'event' => 'required|exists:events,id',
            'file' => 'required|file|mimetypes:video/mp4|mimes:mp4'
        ]);

        $event = Event::where('id', $request->input('event'))->first();

        $path = $request->file('file')->store('raw/'.$event->getFolder());
        $name = $request->file('file')->hashName();

        $file = new File;
        $file->name = $name;
        $file->path = $path;
        $file->save();

        dispatch(new ConvertVideo($file, $event));

        $video = Video::create([
            'event' => $event->id,
            'file' => $file->id,
        ]);
        return response($video, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
