<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/22
 * Time: 9:20 PM.
 */

namespace TimeHunter\BranchingAssessment\Rules;

class XiongjiaRule extends AbstractRule
{
    const RULE_TYPE = 'xiongjia';

    public function getNextQuestionId()
    {
        $question = $this->assessmentProcessor->getCurrentQuestion();
        $rule = $question->getRule();

        return $question->getIsCorrect() === false ? $rule['next'] : $rule['next'];
    }
}
