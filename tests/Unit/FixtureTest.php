<?php

it('fixtures web page returns a successful response', function () {
    $response = $this->get('/fixtures');

    $response->assertStatus(200);
});

it('update all fixtures command', function () {
    $this->artisan('update:clubs-venues')->assertExitCode(0);
    $this->artisan('update:fixtures --type=all')->assertExitCode(0);
});