<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function home() {
        return view('pages/home');
    }

    public function events() {
        return view('pages/events');
    }

    public function news() {
        return view('pages/news');
    }

    public function prices() {
        return view('pages/prices');
    }

    public function contact() {
        return view('pages/contact');
    }
}
