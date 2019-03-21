<?php

namespace TimeHunter\BranchingAssessment\Facades;

use Illuminate\Support\Facades\Facade;

class BranchingAssessment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'BranchingAssessment';
    }
}
