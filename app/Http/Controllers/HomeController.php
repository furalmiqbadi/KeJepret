<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function kejepret()
    {
        return view('kejepret');
    }

    public function search()
    {
        return view('search');
    }

    public function koleksi()
    {
        return view('koleksi');
    }

    public function profil()
    {
        return view('profil');
    }
}
