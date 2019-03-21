<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/19
 * Time: 7:35 PM
 */

namespace TimeHunter\BranchingAssessment\Interfaces;


interface BranchingAssessmentAlgorithm
{

    /**
     * @param string $assessmentDefinition JSON object defining the assessment
     * BranchingAssessmentAlgorithm constructor.
     */
    public function __construct(string $assessmentDefinition);


    /**
     * Flags a question as being completed, with either a correct or incorrect response
     * @param string $questionId The ID of the question
     * @param bool $isCorrect Boolean indicating a correct or incorrect response
     */
    public function setQuestionResponse($questionId, $isCorrect);


    /**
     * Gets the ID of the next question to show to the student
     *
     * @return string|null The ID of the question, or null to end the assessment
     */
    public function getNextQuestionId();

}