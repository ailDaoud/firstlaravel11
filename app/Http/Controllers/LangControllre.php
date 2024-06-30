<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LangControllre extends Controller
{
    public function setlang($local){
        App::setLocale($local);
        Session::put('local',$local);
        $data = Ads::all();
        redirect()->back();
       return View('home',compact('data'));
      // return redirect()->back()->with(View('home',compact('data')));
    //  return redirect()->route('home');
    }
    public function back($local){
        App::setLocale($local);
        Session::put('local',$local);
        return redirect()->back();

    }
    public function a(){
        App::setLocale('ar');
        Session::put('local','ar');
        $data = Ads::all();
        redirect()->back();
       return View('home',compact('data'));

    }
    public function e(){
        App::setLocale('en');
        Session::put('local','en');
        $data = Ads::all();
        redirect()->back();
       return View('home',compact('data'));

    }
}

