<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function event()
    {
        return view('event');
    }

    public function search()
    {
        return view('search');
    }

    public function profil()
    {
        return view('profil');
    }
}
