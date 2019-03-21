<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\BranchingAssessment\Services\BranchingAssessmentFactory;

class AssessmentTest extends TestCase
{
    public function testAssessmentArray()
    {
        $data = [
            'assessment_id' => '1',
            'questions' => [
                [
                    'question_id' => 'A',
                    'correct' => 'C',
                    'incorrect' => 'B',
                ],
                [
                    'question_id' => 'C',
                    'correct' => 'E',
                    'incorrect' => 'F',
                ],
                [
                    'question_id' => 'B',
                    'correct' => 'D',
                    'incorrect' => 'D',
                ],
                [
                    'question_id' => 'D',
                    'correct' => 'C',
                    'incorrect' => 'C',
                ],
                [
                    'question_id' => 'E',
                    'correct' => 'G',
                    'incorrect' => 'G',
                ],
                [
                    'question_id' => 'F',
                    'correct' => 'H',
                    'incorrect' => 'H',
                ],
                [
                    'question_id' => 'H',
                    'correct' => 'G',
                    'incorrect' => null,
                ],
                [
                    'question_id' => 'G',
                    'correct' => null,
                    'incorrect' => null,
                ],
            ],
        ];

        $service = BranchingAssessmentFactory::createAssessmentByArray($data);

        $currentQuestionId = $service->getNextQuestionId();
        $this->assertEquals('A', $currentQuestionId);

        $service->setQuestionResponse($currentQuestionId, true);
        $this->assertEquals(true, $service->getCurrentQuestion()->getIsCorrect());
        $this->assertEquals('C', $service->getCurrentQuestion()->getCorrect());
        $this->assertEquals('B', $service->getCurrentQuestion()->getIncorrect());

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
                    'correct' => 'C',
                    'incorrect' => 'B',
                ],
                [
                    'question_id' => 'C',
                    'correct' => 'E',
                    'incorrect' => 'F',
                ],
                [
                    'question_id' => 'B',
                    'correct' => 'D',
                    'incorrect' => 'D',
                ],
                [
                    'question_id' => 'D',
                    'correct' => 'C',
                    'incorrect' => 'C',
                ],
                [
                    'question_id' => 'E',
                    'correct' => 'G',
                    'incorrect' => 'G',
                ],
                [
                    'question_id' => 'F',
                    'correct' => 'H',
                    'incorrect' => 'H',
                ],
                [
                    'question_id' => 'H',
                    'correct' => 'G',
                    'incorrect' => null,
                ],
                [
                    'question_id' => 'G',
                    'correct' => null,
                    'incorrect' => null,
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
                    'correct' => null,
                    'incorrect' => null,
                ],
                [
                    'question_id' => 'C',
                    'correct' => 'E',
                    'incorrect' => 'F',
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
