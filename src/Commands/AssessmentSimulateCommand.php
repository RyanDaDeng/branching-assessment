<?php

namespace TimeHunter\BranchingAssessment\Commands;

use Illuminate\Console\Command;
use TimeHunter\BranchingAssessment\Factories\BranchingAssessmentFactory;

class AssessmentSimulateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:simulate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'simulate a assessment';

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
            $answer = rand(1, 0) === 1;
            $string = $answer == true ? 'Correct' : 'Incorrect';
            $this->info('> Answer is '.$string);
            $service->setQuestionResponse($currentQuestionId, $answer);
            $this->info('> Checking skip rule '.$service->getCurrentQuestion()->getRule()['type']);
        }
        $this->alert('Assessment Ended');
    }
}
