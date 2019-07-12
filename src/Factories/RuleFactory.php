<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/22
 * Time: 9:48 PM.
 */

namespace TimeHunter\BranchingAssessment\Factories;

use TimeHunter\BranchingAssessment\Rules\XiongjiaRule;
use TimeHunter\BranchingAssessment\Rules\ScoreCheckRule;
use TimeHunter\BranchingAssessment\Rules\SimpleSkipRule;
use TimeHunter\BranchingAssessment\Services\AssessmentProcessor;

class RuleFactory
{
    public static function process(AssessmentProcessor $assessmentProcessor)
    {
        $rule = $assessmentProcessor->getCurrentQuestion()->getRule();
        switch ($rule['type']) {
            case ScoreCheckRule::RULE_TYPE:
                return new ScoreCheckRule($assessmentProcessor);
            case SimpleSkipRule::RULE_TYPE:
                return new SimpleSkipRule($assessmentProcessor);
            case XiongjiaRule::RULE_TYPE:
                return new XiongjiaRule($assessmentProcessor);
            default:
                return;
        }
    }
}
