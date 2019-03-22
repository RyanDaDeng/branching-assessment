<?php

namespace TimeHunter\DeliveryOrderTest\Tests;

use PHPUnit\Framework\TestCase;
use TimeHunter\BranchingAssessment\Models\Question;
use TimeHunter\BranchingAssessment\Models\QuestionMap;

class QuestionMapTest extends TestCase
{
    public function testQuestion()
    {
        $map = new QuestionMap();

        $map->addQuestionToMap(
            Question::create()->setId('1')
        );

        $map->addQuestionToMap(
            Question::create()->setId('2')
        );

        $map->removeQuestionFromMap('2');

        $this->assertEquals(1, $map->getQuestionCount());
        $this->assertEquals(null, $map->getQuestionById('23'));
        $this->assertNotNull($map->__toArray());
    }
}
