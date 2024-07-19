<?php

use App\Console\Commands\UpdateFixtures;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\UpdateClubsVenues;

Schedule::command(UpdateClubsVenues::class)->weekly();

// Schedule::command(UpdateFixtures::class, ['--type=live'])->everyTenMinutes();

Schedule::command(UpdateFixtures::class, ['--league=all'])->everyTenMinutes();

Schedule::command(UpdateFixtures::class, ['--type=all', '--league=all'])->daily();
