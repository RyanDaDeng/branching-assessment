<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\BranchingAssessment\Models\Question;

class QuestionTest extends TestCase
{
    public function testQuestion()
    {
        $question = new Question();
        $question->setId('1')->setRule([
            'type' => 'simple_skip_rule',
            'correct' => 'C',
            'incorrect' => 'B'
        ]);

        $this->assertEquals('1', $question->getId());
        $this->assertEquals([
            'question_id' => '1',
            'rule' => [
                'type' => 'simple_skip_rule',
                'correct' => 'C',
                'incorrect' => 'B'
            ]
        ], $question->__toArray());
    }
}
