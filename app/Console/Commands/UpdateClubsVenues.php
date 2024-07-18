<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ClubVenueService;

class UpdateClubsVenues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:clubs-venues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all premier league clubs with their venues.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $clubsVenuesService = new ClubVenueService();
        $response = $clubsVenuesService->clubsVenuesUpdate();

        $response = $response->getData();

        if($response->status === 'error'){
            $this->output->error('Clubs and venue not updated');
            return;
        }

        $this->output->success('Clubs and venues update successful');
    }
}
