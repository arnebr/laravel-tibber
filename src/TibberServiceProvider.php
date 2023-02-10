<?php

namespace Arnebr\Tibber;

use Arnebr\Tibber\Commands\TibberCommand;
use Illuminate\Notifications\ChannelManager;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Illuminate\Support\Facades\Notification;
class TibberServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-tibber')
            ->hasConfigFile()
            //->hasViews()
            //->hasMigration('create_laravel-tibber_table')
            ->hasCommand(TibberCommand::class);

            Notification::resolved(function (ChannelManager $service) {
                $service->extend('tibber', function ($app) {
                    return new Channels\TibberChannel();
                });
            });
    }
}
