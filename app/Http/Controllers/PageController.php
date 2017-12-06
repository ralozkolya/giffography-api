<?php

namespace App\Http\Controllers;

use App\models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        return view('home');
    }
}
