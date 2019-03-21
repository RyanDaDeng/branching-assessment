<?php
/**
 * Created by PhpStorm.
 * User: dadeng
 * Date: 2019/3/20
 * Time: 9:04 PM
 */

namespace TimeHunter\BranchingAssessment\Models;


class Assessment
{
    /**
     * @var $assessmentId
     */
    private $assessmentId;

    /**
     * @var QuestionMap $questionMap
     */
    private $questionMap;


    /**
     * @param string $assessmentDefinition
     * @return Assessment
     */
    public static function create(string $assessmentDefinition)
    {
        $data = json_decode($assessmentDefinition, 1);
        $new = new self;
        $new->questionMap = new QuestionMap();
        $new->assessmentId = $data['assessment_id'];
        foreach ($data['questions'] as $question) {
            $question = Question::create()
                ->setId($question['question_id'])
                ->setIncorrect($question['incorrect'])
                ->setCorrect($question['correct']);
            $new->questionMap->addQuestionToMap($question);
        }
        return $new;
    }


    /**
     * @return QuestionMap
     */
    public function getQuestionMap(){
        return $this->questionMap;
    }

    /**
     * @return mixed
     */
    public function getAssessmentId(){
        return $this->assessmentId;
    }

    /**
     * Get raw data
     * @return array
     */
    public function __toArray()
    {
        $data = [
            'assessment_id' => $this->assessmentId,
            'questions' => $this->questionMap->__toArray()
        ];

        return $data;
    }
}