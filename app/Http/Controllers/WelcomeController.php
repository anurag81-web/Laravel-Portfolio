<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch hero section data
        $hero = \App\Models\Hero::first();

        // Fetch about me data
        $about = \App\Models\About::first();

        // Fetch skills data
        $skills = \App\Models\Skill::all();

        // Fetch projects data
        $projects = \App\Models\Project::all();

        return view('welcome', compact('hero', 'about', 'skills', 'projects'));
    }
}
