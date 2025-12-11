<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        if ($about) {
            return redirect()->route('admin.about.edit', $about);
        }
        return redirect()->route('admin.about.create');
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'education' => 'nullable|string',
            'email' => 'nullable|email',
            'location' => 'nullable|string',
        ]);

        About::create($data);

        return redirect()->route('admin.about.index')->with('success', 'About section created.');
    }

    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'education' => 'nullable|string',
            'email' => 'nullable|email',
            'location' => 'nullable|string',
        ]);

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'About section updated.');
    }

    public function destroy(About $about)
    {
        $about->delete();
        return redirect()->route('admin.about.index')->with('success', 'About section deleted.');
    }
}
