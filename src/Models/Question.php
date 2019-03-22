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
    private $isCorrect;
    private $rule;

    /**
     * @return Question
     */
    public static function create()
    {
        return new self;
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

    public function getRule()
    {
        return $this->rule;
    }

    public function setRule($value)
    {
        $this->rule = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'question_id' => $this->id,
            'rule' => $this->rule,
        ];
    }
}
