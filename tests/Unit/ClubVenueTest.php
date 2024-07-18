<?php

it('all clubs web page returns a successful response', function () {
    $response = $this->get('/clubs');

    $response->assertStatus(200);
});

it('single club web page returns a successful response', function () {
    $response = $this->get('/clubs/33');

    $response->assertStatus(200);
});

it('update all clubs and venue command', function () {
    $this->artisan('update:clubs-venues')->assertExitCode(0);
});