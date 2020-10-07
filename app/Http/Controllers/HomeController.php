<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function dashboard(){

        return Inertia::render('Dashboard');
    }
    public function carouselView(){

        return Inertia::render('Carousel');
    }
}
