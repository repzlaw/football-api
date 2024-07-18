<?php

namespace App\Services;

use App\Traits\ApiResponse;
use App\Services\ClubService;
use Illuminate\Http\Response;
use App\Services\VenueService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class ClubVenueService
{
    use ApiResponse;

    public $url;
    public $season;
    public $league;
    public $api_key;
    public $ClubService;
    public $VenueService;

    public function __construct() 
    {
        $this->url          = config('api_football.url');
        $this->league       = config('api_football.league');
        $this->season       = config('api_football.season');
        $this->api_key      = config('api_football.api_key');
        $this->ClubService  = new ClubService();
        $this->VenueService = new VenueService();
    }

    public function clubsVenuesUpdate()
    {
        try {
            $response = Http::withHeaders([
                'accept'          => 'application/json',
                'Content-Type'    => 'application/json',
                'x-apisports-key' => $this->api_key
            ])
            ->get("$this->url/teams", [
                'league' => $this->league,
                'season' => $this->season,
            ]);
        } catch (\Exception $e) {
            Log::error('An exception occurred: ' . $e->getMessage());
            return $this->error([],
                $e->getMessage(),
                Response::HTTP_SERVICE_UNAVAILABLE
            );
        }

        //send error if failed
        if($response->failed()){
            return $this->error([],
                'Data not recieved',
                $response->status()
            );
        }

        foreach ($response->json()['response'] as $key => $data) {
            $this->VenueService->update($data['venue']);
            $this->ClubService->update($data['team'], $data['venue']['id']);
        }

        return $this->success($response->json(),
            'success',
            Response::HTTP_OK
        );

    }

}
