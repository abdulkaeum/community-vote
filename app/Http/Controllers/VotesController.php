<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function store(CommunityLink $communityLink)
    {
        auth()->user()->toggleVote($communityLink);

        return back()->with('success', 'Success');
    }
}
