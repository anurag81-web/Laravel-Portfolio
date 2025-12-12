<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::all();
        return view('admin.sociallink.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.sociallink.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        SocialLink::create($request->only('platform', 'url'));

        return redirect()->route('admin.sociallink.index')->with('success', 'Social Link added successfully.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.sociallink.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        $socialLink->update($request->only('platform', 'url'));

        return redirect()->route('admin.sociallink.index')->with('success', 'Social Link updated successfully.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('admin.sociallink.index')->with('success', 'Social Link deleted successfully.');
    }
}
