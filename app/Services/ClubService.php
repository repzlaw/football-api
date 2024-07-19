<?php

namespace App\Services;

use App\Models\Club;
use Illuminate\Support\Str;


class ClubService
{
    public function update($club, $venue_id, $premier_league=true)
    {
        $club = Club::updateOrCreate(
            ['id' => $club['id']],
            [
                'name'     => $club['name'],
                'slug'     => $club['code'] ?? Str::slug($club['name'], '-'),
                'image'    => $club['logo'],
                'venue_id' => $venue_id,
                'league'   => $premier_league ? config('api_football.league') : null
            ]
        );

        return $club;
    }

}
