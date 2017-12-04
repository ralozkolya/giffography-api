<?php

namespace App\Http\Controllers;

use App\models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $data = [];

    public function __construct() {
        $this->data['navigation'] = Page::getNavigation();
    }

    public function home() {
        return view('home', $this->data);
    }
}
