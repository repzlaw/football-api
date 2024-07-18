<?php

return [
    //api-football url and api key
    'url'     => env('API_FOOTBALL_URL', 'https://v3.football.api-sports.io'),
    'season'  => env('API_FOOTBALL_SEASON', '2024'),
    'league'  => env('API_FOOTBALL_LEAGUE', '39'),
    'timezone'=> env('API_FOOTBALL_TIMEZONE', 'Europe/London'),
    'api_key' => env('API_FOOTBALL_API_KEY', 'd827ee626464b2b6b8cfabfa8abe58a5'),
];
