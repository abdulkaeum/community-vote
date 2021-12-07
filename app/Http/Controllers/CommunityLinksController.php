<?php

namespace App\Http\Controllers;

use App\Models\CommunityLinks;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller
{
    public function index()
    {
        $links = CommunityLinks::paginate(25);

        return view('community.index', compact('links'));
    }

    public function store()
    {

    }
}
