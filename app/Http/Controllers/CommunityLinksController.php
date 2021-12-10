<?php

namespace App\Http\Controllers;

use App\Exceptions\DuplicateCommunityLink;
use App\Models\Channels;
use App\Models\CommunityLinks;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommunityLinksController extends Controller
{
    public function index()
    {
        $links = CommunityLinks::where('approved', 1)->latest('updated_at')->paginate(5);
        $channels = Channels::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:5', 'max:50'],
            'link' => ['required', 'min:5', 'url'],
            'channel_id' => ['required', Rule::exists('channels', 'id')],
        ]);

        $isAdmin = auth()->user()->isAdmin();

        try {
            CommunityLinks::fromUser(auth()->user())->contribute($attributes);

            return back()->with(
                $isAdmin ? 'success' : 'info',
                $isAdmin ? 'Thank You!' : 'Post awaiting approval',
            );
        } catch (DuplicateCommunityLink $e) {
            return back()->with('info', 'Link already submitted. We have refreshed the submission date');
        }
    }
}
