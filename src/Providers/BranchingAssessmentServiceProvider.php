<?php

namespace TimeHunter\BranchingAssessment\Providers;


use Illuminate\Support\ServiceProvider;
use TimeHunter\BranchingAssessment\BranchingAssessmentFactory;
use TimeHunter\BranchingAssessment\Commands\AssessmentSimulateCommand;
use TimeHunter\BranchingAssessment\Commands\AssessmentStartCommand;

class BranchingAssessmentServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/branchingassessment.php', 'branchingassessment');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['BranchingAssessment'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Registering package commands.
        $this->commands([
            AssessmentStartCommand::class,
            AssessmentSimulateCommand::class
        ]);
    }
}
