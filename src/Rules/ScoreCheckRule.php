<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/22
 * Time: 9:20 PM
 */

namespace TimeHunter\BranchingAssessment\Rules;


class ScoreCheckRule extends AbstractRule
{
    const RULE_TYPE = 'score_check_rule';

    public function getNextQuestionId()
    {
        $rule = $this->assessmentProcessor->getCurrentQuestion()->getRule();
        $currentScore = $this->assessmentProcessor->getCurrentScore();
        return $currentScore >= $rule['threshold'] ? $rule['next'] : $rule['default'];
    }
}