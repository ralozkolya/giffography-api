<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Video;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response(Event::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'parent' => 'exists:events,id',
            'date' => 'date',
        ]);

        $event = Event::create($request->all());
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
        return response(Video::where('event', $id)->paginate(20));
    }
}
