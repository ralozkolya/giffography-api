<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Page extends Model
{
    public static function getNavigation() {
        $locale = App::getLocale();
        return Page::select(["{$locale}_name as name", "path"])->orderBy('priority')->get();
    }
}
