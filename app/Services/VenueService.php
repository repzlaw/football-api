<?php

namespace App\Services;

use App\Models\Venue;
use Illuminate\Support\Str;

class VenueService
{
    public function update($venue)
    {
        Venue::updateOrCreate(
            ['id' => $venue['id']],
            [
                'name' => $venue['name'],
                'slug' => Str::slug($venue['name'], '-')
            ]
        );
    }

}
