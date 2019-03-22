<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/22
 * Time: 9:22 PM.
 */

namespace TimeHunter\BranchingAssessment\Rules;

use TimeHunter\BranchingAssessment\Interfaces\RuleInterface;
use TimeHunter\BranchingAssessment\Services\AssessmentProcessor;

abstract class AbstractRule implements RuleInterface
{
    const RULE_TYPE = '';
    protected $assessmentProcessor;

    public function __construct(AssessmentProcessor $assessmentProcessor)
    {
        $this->assessmentProcessor = $assessmentProcessor;
    }
}
