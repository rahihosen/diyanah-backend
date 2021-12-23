<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class LandingController extends Controller
{
    public function index(){
        $categories = Category::OrderBy('id', 'DESC')->get();
        return view('landing.index')->with(compact(['categories']));
    }
}
