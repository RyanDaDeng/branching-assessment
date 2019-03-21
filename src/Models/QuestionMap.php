<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/20
 * Time: 9:04 PM
 */

namespace TimeHunter\BranchingAssessment\Models;

class QuestionMap
{

    /**
     * Using collect for question map
     * @var \Illuminate\Support\Collection
     */
    private $questionMap;

    /**
     * number of question
     * @var int $questionCount
     */
    private $questionCount = 0;

    /**
     * QuestionMap constructor.
     */
    public function __construct()
    {
        $this->questionMap = collect();
    }

    /**
     * @return int
     */
    public function getQuestionCount()
    {
        return $this->questionCount;
    }

    /**
     * @return Question
     */
    public function getFirstQuestion()
    {
        return $this->questionMap->first();
    }

    /**
     * @param $newCount
     */
    private function setQuestionCount($newCount)
    {
        $this->questionCount = $newCount;
    }

    /**
     * @param Question $question
     */
    public function addQuestionToMap(Question $question)
    {
        $this->questionMap->put($question->getId(), $question);
        $this->setQuestionCount($this->getQuestionCount() + 1);
    }

    /**
     * @param Question $question
     */
    public function removeQuestionFromMap(Question $question)
    {

        if ($this->questionMap->has($question->getId())) {
            $this->questionMap->pull($question->getId());
            $this->setQuestionCount($this->getQuestionCount() - 1);
        }

    }

    /**
     * @param $questionId
     * @return Question|null
     */
    public function getQuestionById($questionId)
    {
        if ($this->questionMap->has($questionId)) {
            return $this->questionMap->get($questionId);
        } else {
            return null;
        }
    }

    /**
     * @return array
     */
    public function __toArray()
    {
        $data = [];
        foreach ($this->questionMap as $row) {
            /**
             * @var Question $row
             */
            $data[] = $row->__toArray();
        }
        return $data;
    }
}