<?php

namespace Arnebr\Tibber;

use Arnebr\Tibber\Commands\TibberCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
    }
}
