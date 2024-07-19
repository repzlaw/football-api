<?php

namespace App\Services;

use App\Models\Club;
use App\Models\Round;
use App\Models\Fixture;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class FixtureService
{
    use ApiResponse;

    public $url;
    public $season;
    public $league;
    public $api_key;
    public $timezone;
    public $ClubService;
    public $VenueService;

    public function __construct() 
    {
        $this->url          = config('api_football.url');
        $this->league       = config('api_football.league');
        $this->season       = config('api_football.season');
        $this->api_key      = config('api_football.api_key');
        $this->timezone     = config('api_football.timezone');
        $this->ClubService  = new ClubService();
        $this->VenueService = new VenueService();
    }

    public function getPremierLeagueData($type)
    {
        $queries = [
            'league'   => $this->league,
            'season'   => $this->season,
            'timezone' => $this->timezone,
        ];

        if ($type == 'live'){
            $queries['live'] = 'all'; 
        }

        try {
            $response = Http::withHeaders([
                'accept'          => 'application/json',
                'Content-Type'    => 'application/json',
                'x-apisports-key' => $this->api_key
            ])
            ->get("$this->url/fixtures", $queries);
        } catch (\Exception $e) {
            Log::error('An exception occurred: ' . $e->getMessage());
            return $this->error([],
                $e->getMessage(),
                Response::HTTP_SERVICE_UNAVAILABLE
            );
        }

        $this->updatePremierLeague($response->json()['response']);

        return $this->success($response->json(),
            'success',
            Response::HTTP_OK
        );

    }

    public function getAllLeaguesData($type)
    {
        $clubs = Club::all();

        foreach ($clubs as $key => $club) {
            $queries = [
                'team'   => $club->id,
                'season'   => $this->season,
                'timezone' => $this->timezone,
            ];
    
            if ($type == 'live'){
                $queries['live'] = 'all'; 
            }
    
            try {
                $response = Http::withHeaders([
                    'accept'          => 'application/json',
                    'Content-Type'    => 'application/json',
                    'x-apisports-key' => $this->api_key
                ])
                ->get("$this->url/fixtures", $queries);
            } catch (\Exception $e) {
                Log::error('An exception occurred: ' . $e->getMessage());
                return $this->error([],
                    $e->getMessage(),
                    Response::HTTP_SERVICE_UNAVAILABLE
                );
            }
    
            $this->updateAllLeagues($response->json()['response']);
        }


        return $this->success($response->json(),
            'success',
            Response::HTTP_OK
        );

    }

    public function updatePremierLeague($fixtures)
    {
        foreach ($fixtures as $fixture) 
        {
            // Retrieve round by name or instantiate a new round instance...
            $round = Round::firstOrCreate([
                'league' => $this->league,
                'season' => $this->season,
                'name'   => $fixture['league']['round']
            ]); 

            Fixture::updateOrCreate(
                ['id' => $fixture['fixture']['id']],
                [
                    'home_club_id'    => $fixture['teams']['home']['id'],
                    'away_club_id'    => $fixture['teams']['away']['id'],
                    'venue_id'        => $fixture['fixture']['venue']['id'],
                    'home_club_score' => $fixture['goals']['home'],
                    'away_club_score' => $fixture['goals']['away'],
                    'kick_off'        => $fixture['fixture']['timestamp'],
                    'round_id'        => $round->id,
                ]
            );
        }
    }

    public function updateAllLeagues($fixtures)
    {
        foreach ($fixtures as $fixture) 
        {
            // Retrieve round by name or instantiate a new round instance...
            $round = Round::firstOrCreate([
                'league' => $fixture['league']['id'],
                'season' => $fixture['league']['season'],
                'name'   => $fixture['league']['round']
            ]); 

            $this->VenueService->update($fixture['fixture']['venue']);
            $this->ClubService->update($fixture['teams']['home'], $fixture['fixture']['venue']['id'], false);
            $this->ClubService->update($fixture['teams']['away'], $fixture['fixture']['venue']['id'], false);

            Fixture::updateOrCreate(
                ['id' => $fixture['fixture']['id']],
                [
                    'home_club_id'    => $fixture['teams']['home']['id'],
                    'away_club_id'    => $fixture['teams']['away']['id'],
                    'venue_id'        => $fixture['fixture']['venue']['id'],
                    'home_club_score' => $fixture['goals']['home'],
                    'away_club_score' => $fixture['goals']['away'],
                    'kick_off'        => $fixture['fixture']['timestamp'],
                    'round_id'        => $round->id,
                ]
            );
        }
    }
}
