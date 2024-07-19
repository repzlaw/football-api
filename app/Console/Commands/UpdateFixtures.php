<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FixtureService;

class UpdateFixtures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:fixtures {--T|type=live} {--L|league=premier_league}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all fixtures';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->option('type') ?? 'live';
        $league = $this->option('league') ?? 'live';

        if ($type !== 'live' && $type !== 'all') {
            $this->output->error('Invalid Type');
            return;
        }

        if ($league !== 'premier_league' && $league !== 'all') {
            $this->output->error('Invalid League');
            return;
        }

        $FixtureService = new FixtureService();

        if ($league === 'premier_league') {
            $response = $FixtureService->getPremierLeagueData($type);
        } else {
            $response = $FixtureService->getAllLeaguesData($type);
        }

        $response = $response->getData();

        if($response->status === 'error'){
            $this->output->error('Fixtures not updated');
            return;
        }

        $this->output->success('Fixtures update successful');

    }
}
