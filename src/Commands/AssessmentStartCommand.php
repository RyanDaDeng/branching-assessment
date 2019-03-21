<?php

namespace TimeHunter\BranchingAssessment\Commands;

use Illuminate\Console\Command;
use TimeHunter\BranchingAssessment\Services\BranchingAssessmentFactory;

class AssessmentStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start your assessment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->alert('Start your assessment');
        $data = config('branchingassessment')->get('assessment');
        $service = BranchingAssessmentFactory::createAssessmentByArray($data);
        while ($currentQuestionId = $service->getNextQuestionId()) {
            $this->warn('Attempting question #'.$service->getCurrentQuestion()->getId().'...');
            $correct = $this->choice('Choose Correct or Incorrect answer?', ['Correct', 'Incorrect']);
            $service->setQuestionResponse($currentQuestionId, $correct == 0 ? true : false);
        }
        $this->alert('Assessment Ended');
    }
}
