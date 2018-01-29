@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7 col-xs-10 col-xs-offset-1">
                <div class="events-container">
                    <div class="decorative-frame blue"></div>
                    <div class="decorative-frame pink"></div>
                    <div class="decorative-frame pink-segment"></div>
                    <div class="events-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
