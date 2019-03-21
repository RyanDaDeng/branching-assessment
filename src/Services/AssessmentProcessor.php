<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/20
 * Time: 9:04 PM.
 */

namespace TimeHunter\BranchingAssessment\Services;

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
        $this->assessment->getQuestionMap()->getQuestionById($questionId)->setIsCorrect($isCorrect);
    }

    /**
     * Get next question.
     * @return null|string
     */
    public function getNextQuestionId()
    {
        // if current question is null, set first element from map as first question
        if (! $this->currentQuestionId) {
            return $this->currentQuestionId = $this->assessment->getQuestionMap()->getFirstQuestion()->getId();
        }

        // if the question has branching logic
        // if its null which means the assessment ended.
        if ($this->hasNextQuestion()) {
            $this->currentQuestionId = $this->getCurrentQuestion()->getNextQuestionId();
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
     * Check if the current question has next question.
     * @return bool
     */
    public function hasNextQuestion()
    {
        return $this->getCurrentQuestion()->getNextQuestionId() === null ? false : true;
    }

    /**
     * @return Assessment
     */
    public function getAssessment()
    {
        return $this->assessment;
    }
}
