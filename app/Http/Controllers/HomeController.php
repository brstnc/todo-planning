<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $developers = Developer::all();
        return view('welcome', compact('developers'));
    }
}
