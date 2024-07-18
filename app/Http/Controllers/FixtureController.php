<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FixtureController extends Controller
{
    // get all fixtures grouped by round
    public function index() : Collection {
        $fixturesGroupedByRound = Round::with('fixtures')
            ->get();

        return $fixturesGroupedByRound;
    }
}
