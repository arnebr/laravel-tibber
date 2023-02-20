<?php

use Arnebr\Tibber\Facades\Tibber;

it('can make request', function () {
    $tibber = Tibber::viewer();
    expect($tibber)->toBeArray();
});

it('can make viewer request', function () {
    $tibber = Tibber::viewer();
    expect($tibber)->toBeArray();
    expect( $tibber)->toHaveKeys(['data.viewer.login']);
});
it('can make home request', function () {
    $tibber = Tibber::homes();
    expect($tibber)->toBeArray();
    expect( $tibber)->toHaveKeys(['data.viewer.login']);
    expect( $tibber)->toHaveKeys(['data.viewer.homes']);
});
it('can make consumption request', function () {
    $tibber = Tibber::consumption();
    expect($tibber)->toBeArray();
    expect( $tibber)->toHaveKeys(['data.viewer.login']);
    expect( $tibber)->toHaveKeys(['data.viewer.homes']);
    expect( $tibber)->toHaveKeys(['data.viewer.homes.0.consumption']);
    expect( $tibber)->toHaveKeys(['data.viewer.homes.0.consumption.nodes']);
});
it('can make push notification request', function () {
    $tibber = Tibber::sendPushNotification('test', 'test');
    expect($tibber)->toBeArray();
    expect($tibber['errors'][0]['message'])->toBe('operation not allowed for demo user');
});
