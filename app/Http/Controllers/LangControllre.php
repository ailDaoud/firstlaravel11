<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LangControllre extends Controller
{
    public function setlang($local){
        App::setLocale($local);
        Session::put('local',$local);
        return redirect()->back();
    }
}
