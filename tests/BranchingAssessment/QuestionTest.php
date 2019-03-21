<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\BranchingAssessment\Models\Question;
use TimeHunter\BranchingAssessment\Services\BranchingAssessmentFactory;

class QuestionTest extends TestCase
{
    public function testQuestion()
    {

        $question = new Question();
        $question->setId('1')
            ->setIncorrect('B')
            ->setCorrect('C');
        $this->assertEquals('1', $question->getId());
        $this->assertEquals('B', $question->getIncorrect());
        $this->assertEquals('C', $question->getCorrect());
        $this->assertEquals([
            'question_id' => '1',
            'correct' => 'C',
            'incorrect' => 'B'
        ], $question->__toArray());
    }

}
