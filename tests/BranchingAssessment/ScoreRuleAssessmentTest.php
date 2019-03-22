<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\BranchingAssessment\Factories\BranchingAssessmentFactory;

class ScoreRuleAssessmentTest extends TestCase
{
    public function testAssessmentArray()
    {
        $data = [
            'assessment_id' => '2',
            'questions' => [
                [
                    'question_id' => 'A',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'C',
                        'incorrect' => 'C',
                    ],
                ],
                [
                    'question_id' => 'C',
                    'rule' => [
                        'type' => 'score_check_rule',
                        'threshold' => 2,
                        'next' => 'E',
                        'default' => 'F',
                    ],
                ],
                [
                    'question_id' => 'E',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => null,
                        'incorrect' => null,
                    ],
                ],
                [
                    'question_id' => 'F',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => null,
                        'incorrect' => null,
                    ],
                ],
            ],
        ];

        $service = BranchingAssessmentFactory::createAssessmentByArray($data);

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('A', $currentQuestionId);
        $service->setQuestionResponse($currentQuestionId, true);

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('C', $currentQuestionId);
        $service->setQuestionResponse($currentQuestionId, true);

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('E', $currentQuestionId);
        $service->setQuestionResponse($currentQuestionId, true);
    }

    public function testAssessmentArray2()
    {
        $data = [
            'assessment_id' => '2',
            'questions' => [
                [
                    'question_id' => 'A',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'C',
                        'incorrect' => 'C',
                    ],
                ],
                [
                    'question_id' => 'C',
                    'rule' => [
                        'type' => 'score_check_rule',
                        'threshold' => 2,
                        'next' => 'E',
                        'default' => 'F',
                    ],
                ],
                [
                    'question_id' => 'E',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => null,
                        'incorrect' => null,
                    ],
                ],
                [
                    'question_id' => 'F',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => null,
                        'incorrect' => null,
                    ],
                ],
            ],
        ];

        $service = BranchingAssessmentFactory::createAssessmentByArray($data);

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('A', $currentQuestionId);
        $service->setQuestionResponse($currentQuestionId, true);

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('C', $currentQuestionId);
        $service->setQuestionResponse($currentQuestionId, false);

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('F', $currentQuestionId);
        $service->setQuestionResponse($currentQuestionId, true);
    }
}
