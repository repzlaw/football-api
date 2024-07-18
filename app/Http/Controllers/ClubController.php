<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Support\Collection;

class ClubController extends Controller
{
    // get all clubs
    public function index() : Collection {
        $clubs = Club::all();

        return $clubs;
    }

    // show club
    public function show($slug) {
        $club = Club::where('id', $slug)
            ->orWhere('slug', $slug)
            ->first();

        return $club;
    }
}
