<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch hero section data
        $hero = DB::table('hero_section')->first();

        // Fetch about me data
        $about = DB::table('about_me')->first();

        // Fetch skills data
        $skills = DB::table('skills')->orderBy('id', 'ASC')->get();

        // Fetch projects data
        $projects = DB::table('projects')->orderBy('id', 'ASC')->get();

        return view('welcome', compact('hero', 'about', 'skills', 'projects'));
    }
}
