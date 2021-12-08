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
        $links = CommunityLinks::latest()->paginate(5);
        $channels = Channels::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels'));
    }

    public function store(Request $request)
    {
        $attribites = $request->validate([
            'title' => ['required', 'min:5', 'max:50'],
            'link' => ['required', 'min:5', 'url', Rule::unique('community_links', 'link')],
            'channel_id' => ['required', Rule::exists('channels', 'id')],
        ]);

        $attribites['user_id'] = auth()->user()->id;

        CommunityLinks::create($attribites);

        return back();
    }
}
