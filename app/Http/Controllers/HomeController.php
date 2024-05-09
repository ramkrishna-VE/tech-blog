<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $blogs = Blog::where('status', 1)->get();
        return view('welcome', compact('blogs'));
    }

    public function single($slug){
        $blog = Blog::where('slug', $slug)->where('status', 1)->first();
        return view('single', compact('blog'));
    }

}
