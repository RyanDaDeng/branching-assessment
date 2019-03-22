<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/22
 * Time: 9:20 PM.
 */

namespace TimeHunter\BranchingAssessment\Rules;

class SimpleSkipRule extends AbstractRule
{
    const RULE_TYPE = 'simple_skip_rule';

    public function getNextQuestionId()
    {
        $question = $this->assessmentProcessor->getCurrentQuestion();
        $rule = $question->getRule();

        return $question->getIsCorrect() === true ? $rule['correct'] : $rule['incorrect'];
    }
}
