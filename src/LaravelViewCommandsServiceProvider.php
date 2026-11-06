<?php
namespace RoySandip\LaravelViewCommands;

use Illuminate\Support\ServiceProvider;
use RoySandip\LaravelViewCommands\Commands\MakeCustomViewCommand;

class LaravelViewCommandsServiceProvider extends ServiceProvider
{
    /**
     * Register the package's additional Artisan commands.
     */
    public function boot(): void
    {
        if($this->app->runningInConsole()) 
        {
            $this->commands([MakeCustomViewCommand::class,]);
        }
    }
}
