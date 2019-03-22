<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/20
 * Time: 9:04 PM.
 */

namespace TimeHunter\BranchingAssessment\Services;

use TimeHunter\BranchingAssessment\Factories\RuleFactory;
use TimeHunter\BranchingAssessment\Models\Question;
use TimeHunter\BranchingAssessment\Models\Assessment;
use TimeHunter\BranchingAssessment\Interfaces\BranchingAssessmentAlgorithm;

class AssessmentProcessor implements BranchingAssessmentAlgorithm
{
    /**
     * @var Assessment
     */
    public $assessment;

    /**
     * @var Question
     */
    protected $currentQuestionId;

    /**
     * @var int
     */
    protected $currentScore = 0;

    /**
     * Assessment constructor.
     * @param string $assessmentDefinition
     */
    public function __construct(string $assessmentDefinition)
    {
        $this->assessment = Assessment::create($assessmentDefinition);
    }

    /**
     * Set question response.
     * @param string $questionId
     * @param bool $isCorrect
     */
    public function setQuestionResponse($questionId, $isCorrect)
    {
        if ($isCorrect === true) {
            $this->currentScore++;
        }

        $this->assessment->getQuestionMap()->getQuestionById($questionId)->setIsCorrect($isCorrect);
    }

    /**
     * Get next question.
     * @return null|string
     */
    public function getNextQuestionId()
    {
        // if current question is null, set first element from map as first question
        if (!$this->currentQuestionId) {
            return $this->currentQuestionId = $this->assessment->getQuestionMap()->getFirstQuestion()->getId();
        }

        // if the question has branching logic
        // if its null which means the assessment ended.


        $nextQuestionId = RuleFactory::process($this)->getNextQuestionId();
        if ($nextQuestionId) {
            $this->currentQuestionId = $nextQuestionId;
            return $this->getCurrentQuestion()->getId();
        } else {
            return;
        }
    }

    /**
     * Get current in attempting question.
     * @return Question|null
     */
    public function getCurrentQuestion()
    {
        return $this->currentQuestionId ? $this->assessment->getQuestionMap()->getQuestionById($this->currentQuestionId) : null;
    }


    /**
     * @return Assessment
     */
    public function getAssessment()
    {
        return $this->assessment;
    }

    /**
     * @return int
     */
    public function getCurrentScore()
    {
        return $this->currentScore;
    }
}
