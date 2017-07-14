<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\File;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller {

    public function __construct() {
        $this->middleware('auth:api')->except(['index', 'show', 'videos']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response(Event::paginate(40));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'ka_name' => 'required',
            'en_name' => 'required',
            'parent' => 'exists:events,id',
            'date' => 'date',
            'file' => 'file|mimetypes:image/png,image/jpeg,image/gif|mimes:png,jpg,jpeg,gif',
        ]);

        $event = null;

        DB::transaction(function () use (&$request, &$event) {
            $event = Event::create($request->all());

            if($request->file('file')) {
                $path = $request->file('file')->store("public/{$event->getFolder()}");

                $file = new File();
                $file->path = $path;
                $file->save();

                $event->thumb = $file->id;
            }
            
            $event->save();
        });

        return response($event, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event) {
        return response($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event) {
        $this->validate($request, [
            'date' => 'date',
            'parent' => 'exists:events,id',
        ]);

        $event->update($request->all());
        return response($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event) {
        $event->delete();
        return response(null, 204);
    }

    public function videos($id) {
        return response(Video::where('event', $id)
            ->whereNotNull('converted')->orderBy('id', 'desc')->paginate(40));
    }
}
