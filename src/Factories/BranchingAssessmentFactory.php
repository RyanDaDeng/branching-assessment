<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/21
 * Time: 8:23 PM.
 */

namespace TimeHunter\BranchingAssessment\Factories;

use TimeHunter\BranchingAssessment\Services\AssessmentProcessor;

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
     * @param $configKey
     * @return AssessmentProcessor
     */
    public static function createAssessmentFromConfig($configKey)
    {
        return self::createAssessmentByArray(config("branchingassessment.$configKey"));
    }
}
