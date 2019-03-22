<?php

namespace TimeHunter\BranchingAssessment\Commands;

use Illuminate\Console\Command;
use TimeHunter\BranchingAssessment\Factories\BranchingAssessmentFactory;

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
        $assessments = config('branchingassessment');
        $assessmentIds = collect($assessments)->keys();
        $choice = $this->choice('Choose Correct or Incorrect answer?', $assessmentIds->toArray());
        $data = $assessments[$choice];
        $service = BranchingAssessmentFactory::createAssessmentByArray($data);
        while ($currentQuestionId = $service->getNextQuestionId()) {
            $this->warn('Attempting question #'.$service->getCurrentQuestion()->getId().'...'.'Your current score is: '.$service->getCurrentScore());
            $correct = $this->choice('Choose Correct or Incorrect answer?', ['Correct', 'Incorrect']);
            $this->info('> Answer is '.$correct);
            $service->setQuestionResponse($currentQuestionId, $correct === 'Correct' ? true : false);
            $this->info('> Checking skip rule '.$service->getCurrentQuestion()->getRule()['type']);
        }
        $this->alert('Assessment Ended');
    }
}
