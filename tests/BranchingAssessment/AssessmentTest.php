<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\BranchingAssessment\Factories\BranchingAssessmentFactory;

class AssessmentTest extends TestCase
{
    public function testAssessmentArray()
    {
        $data = [
            'assessment_id' => '1',
            'questions' => [
                [
                    'question_id' => 'A',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'C',
                        'incorrect' => 'B'
                    ]
                ],
                [
                    'question_id' => 'C',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'E',
                        'incorrect' => 'F'
                    ]
                ],
                [
                    'question_id' => 'B',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'D',
                        'incorrect' => 'D'
                    ]
                ],
                [
                    'question_id' => 'D',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'C',
                        'incorrect' => 'C'
                    ]
                ],
                [
                    'question_id' => 'E',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'G',
                        'incorrect' => 'G'
                    ]
                ],
                [
                    'question_id' => 'F',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'H',
                        'incorrect' => 'H'
                    ]
                ],
                [
                    'question_id' => 'H',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'G',
                        'incorrect' => NULL
                    ]
                ],
                [
                    'question_id' => 'G',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => NULL,
                        'incorrect' => NULL
                    ]
                ],
            ],
        ];

        $service = BranchingAssessmentFactory::createAssessmentByArray($data);

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('A', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, true);
        $this->assertEquals(true, $service->getCurrentQuestion()->getIsCorrect());


        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('C', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, false);
        $this->assertEquals(false, $service->getCurrentQuestion()->getIsCorrect());
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('F', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, true);
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('H', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, true);
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('G', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, false);
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals(null, $currentQuestionId);
    }

    public function testAssessmentJson()
    {
        $data = [
            'assessment_id' => '1',
            'questions' => [
                [
                    'question_id' => 'A',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'C',
                        'incorrect' => 'B'
                    ]
                ],
                [
                    'question_id' => 'C',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'E',
                        'incorrect' => 'F'
                    ]
                ],
                [
                    'question_id' => 'B',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'D',
                        'incorrect' => 'D'
                    ]
                ],
                [
                    'question_id' => 'D',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'C',
                        'incorrect' => 'C'
                    ]
                ],
                [
                    'question_id' => 'E',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'G',
                        'incorrect' => 'G'
                    ]
                ],
                [
                    'question_id' => 'F',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'H',
                        'incorrect' => 'H'
                    ]
                ],
                [
                    'question_id' => 'H',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'G',
                        'incorrect' => null
                    ]
                ],
                [
                    'question_id' => 'G',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => null,
                        'incorrect' => null
                    ]
                ],
            ],
        ];

        $service = BranchingAssessmentFactory::createAssessmentByJson(json_encode($data));

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('A', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, true);
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('C', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, false);
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('F', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, true);
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('H', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, true);
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('G', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, false);
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals(null, $currentQuestionId);
    }

    public function testAssessment3()
    {
        $data = [
            'assessment_id' => '1',
            'questions' => [
                [
                    'question_id' => 'A',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => null,
                        'incorrect' => null
                    ]
                ],
                [
                    'question_id' => 'C',
                    'rule' => [
                        'type' => 'simple_skip_rule',
                        'correct' => 'E',
                        'incorrect' => 'F'
                    ]
                ],
            ],
        ];

        $service = BranchingAssessmentFactory::createAssessmentByJson(json_encode($data));

        $assessment = $service->getAssessment();
        $this->assertEquals('1', $assessment->getAssessmentId());

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('A', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, true);
        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals(null, $currentQuestionId);
    }
}
