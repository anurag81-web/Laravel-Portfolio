<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        if ($hero) {
            return redirect()->route('admin.hero.edit', $hero);
        }
        return redirect()->route('admin.hero.create');
    }

    public function create()
    {
        // If a hero section already exists, redirect to edit to enforce singleton pattern (optional but good UX)
        if (Hero::count() > 0) {
            return redirect()->route('admin.hero.edit', Hero::first())->with('warning', 'Hero section already exists. Please edit the existing one.');
        }
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'required|string',
            'profile_image' => 'nullable|image|max:40960',
            'cv_link' => 'nullable|file|mimes:pdf|max:40960',
        ]);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('hero', 'public');
        }

        if ($request->hasFile('cv_link')) {
            $data['cv_link'] = $request->file('cv_link')->store('hero_cv', 'public');
        }

        Hero::create($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero section created.');
    }

    public function edit(Hero $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'profile_image' => 'nullable|image|max:40960',
            'cv_link' => 'nullable|file|mimes:pdf|max:40960',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($hero->profile_image) {
                Storage::disk('public')->delete($hero->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('hero', 'public');
        }

        if ($request->hasFile('cv_link')) {
            if ($hero->cv_link) {
                Storage::disk('public')->delete($hero->cv_link);
            }
            $data['cv_link'] = $request->file('cv_link')->store('hero_cv', 'public');
        }

        $hero->update($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero updated.');
    }
}
