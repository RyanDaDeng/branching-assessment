<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/21
 * Time: 8:23 PM.
 */

namespace TimeHunter\BranchingAssessment\Services;

class BranchingAssessmentFactory
{
    /**
     * @param $json
     * @return AssessmentProcessor
     */
    public static function createAssessmentByJson($json)
    {
        return new AssessmentProcessor($json);
    }

    /**
     * @param $array
     * @return AssessmentProcessor
     */
    public static function createAssessmentByArray($array)
    {
        return new AssessmentProcessor(json_encode($array));
    }

    /**
     * @return AssessmentProcessor
     */
    public static function createAssessmentFromConfig()
    {
        return self::createAssessmentByArray(config('branchingassessment')->get('assessment'));
    }
}
