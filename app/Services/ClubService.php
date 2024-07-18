<?php

namespace App\Services;

use App\Models\Club;


class ClubService
{
    public function update($club, $venue_id)
    {
        Club::updateOrCreate(
            ['id' => $club['id']],
            [
                'name'     => $club['name'],
                'slug'     => $club['code'],
                'image'    => $club['logo'],
                'venue_id' => $venue_id
            ]
        );
    }

}
