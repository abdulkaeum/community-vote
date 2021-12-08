<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use App\Models\CommunityLinks;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommunityLinksController extends Controller
{
    public function index()
    {
        $links = CommunityLinks::where('approved', 1)->latest()->paginate(5);
        $channels = Channels::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:5', 'max:50'],
            'link' => ['required', 'min:5', 'url', Rule::unique('community_links', 'link')],
            'channel_id' => ['required', Rule::exists('channels', 'id')],
        ]);

        $attributes['user_id'] = auth()->user()->id;

        if (auth()->user()->isAdmin()) {
            $attributes['approved'] = true;
        }

        CommunityLinks::create($attributes);

        return back();
    }
}
