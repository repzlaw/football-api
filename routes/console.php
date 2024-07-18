<?php

use App\Console\Commands\UpdateFixtures;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\UpdateClubsVenues;

Schedule::command(UpdateClubsVenues::class)->weekly();

Schedule::command(UpdateFixtures::class)->everyTenMinutes();

Schedule::command(UpdateFixtures::class, ['--type=all'])->daily();
