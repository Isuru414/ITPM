<?php

namespace App\Http\Controllers;

use App\WallManagement;

class wallmanagementcontroller extends Controller
{
    public function something(){

        $WallManagements = WallManagement::orderby('id', 'desc')->get();
         return view('wall', compact('WallManagements'));

        // $courses = Course::where('published', 1)->orderby('id', 'desc')->get();
        // return view('course', compact('courses'));
    }
}
