<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\BranchingAssessment\Services\AssessmentProcessor;
use TimeHunter\BranchingAssessment\Services\BranchingAssessmentFactory;

class FactoryTest extends TestCase
{
    public function testFactory1()
    {
        $data = [
            'assessment_id' => '1',
            'questions' => [
                [
                    'question_id' => 'A',
                    'correct' => 'C',
                    'incorrect' => 'B',
                ],
            ],
        ];

        $service = BranchingAssessmentFactory::createAssessmentByArray($data);

        $this->assertInstanceOf(AssessmentProcessor::class, $service);
    }

    public function testFactory2()
    {
        $data = [
            'assessment_id' => '1',
            'questions' => [
                [
                    'question_id' => 'A',
                    'correct' => 'C',
                    'incorrect' => 'B',
                ],
            ],
        ];

        $service = BranchingAssessmentFactory::createAssessmentByJson(json_encode($data));

        $this->assertInstanceOf(AssessmentProcessor::class, $service);
    }
}
