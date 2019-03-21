<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/20
 * Time: 9:04 PM.
 */

namespace TimeHunter\BranchingAssessment\Models;

class Question
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $correct;
    /**
     * @var string
     */
    private $incorrect;
    /**
     * @var string
     */
    private $isCorrect;

    /**
     * @return Question
     */
    public static function create()
    {
        return new self;
    }

    /**
     * @return string|null
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * @param $correct
     * @return Question
     */
    public function setCorrect($correct): self
    {
        $this->correct = $correct;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIncorrect()
    {
        return $this->incorrect;
    }

    /**
     * @param $incorrect
     * @return Question
     */
    public function setIncorrect($incorrect): self
    {
        $this->incorrect = $incorrect;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return Question
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param bool $isCorrect
     */
    public function setIsCorrect(bool $isCorrect)
    {
        $this->isCorrect = $isCorrect;
    }

    /**
     * @return string
     */
    public function getIsCorrect()
    {
        return $this->isCorrect;
    }

    /**
     * @return string
     */
    public function getNextQuestionId()
    {
        return $this->isCorrect === true ? $this->correct : $this->incorrect;
    }

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'question_id' => $this->id,
            'correct' => $this->correct,
            'incorrect' => $this->incorrect,
        ];
    }
}
