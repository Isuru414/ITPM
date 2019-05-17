<?php

namespace App\Http\Controllers;

use App\DigitalLibrary;

class digitallibbrarycontroller extends Controller
{
    public function something(){

        $DigitalLibrarys = DigitalLibrary::orderby('id', 'desc')->get();
         return view('digital', compact('DigitalLibrarys'));

        // $courses = Course::where('published', 1)->orderby('id', 'desc')->get();
        // return view('course', compact('courses'));
    }
}
