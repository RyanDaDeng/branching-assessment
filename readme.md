# DeliveryOrderTest

[![Coverage Status][ico-coverage]][link-coverage]
[![Build][ico-build]][link-build]
[![StyleCI][ico-styleci]][link-styleci]



## Description

The solution is written on Laravel framework. The solution has not fully finished yet.

## Installation

1. This is a Laravel composer package, you need to have a Laravel installed first.
2. Via Composer

``` bash
$ composer require timehunter/branchingassessment
```

3. publish assessment config

``` bash
$ php artisan vendor:publish --provider="TimeHunter\BranchingAssessment\Providers\BranchingAssessmentServiceProvider" 
```

It will publish a branchingassessment.php config file under config directory, this will be used for you to simulate and play around with the package.


## Usage

````php

 $service = BranchingAssessmentFactory::createAssessmentByArray($data);
 
 $service->getNextQuestionId() // first time get fist question
 
 $service->setQuestionResponse($questionId, $isCorrect);
 
````

## Commands Simulation

1. Remember to publish the config file
2. Go to branchingassessment.php config file, you can define your own assessment structure, by default, the structure follows the given diagram from the assessment.
3. Run the following command to simulate the assessment
``` bash
$ php artisan assessment:simulate
```
or run the following command to manually play the assessment:
``` bash
$ php artisan assessment:start
```


## Solution


#### Designs


The JSON sample object:

````
{
  "assessment": {
    "assessment_id": "1",
    "questions": [
      {
        "question_id": "A",
        "correct": "C",
        "incorrect": "B"
      },
      {
        "question_id": "C",
        "correct": "E",
        "incorrect": "F"
      },
      {
        "question_id": "B",
        "correct": "D",
        "incorrect": "D"
      },
      {
        "question_id": "D",
        "correct": "C",
        "incorrect": "C"
      },
      {
        "question_id": "E",
        "correct": "G",
        "incorrect": "G"
      },
      {
        "question_id": "F",
        "correct": "H",
        "incorrect": "H"
      },
      {
        "question_id": "H",
        "correct": "G",
        "incorrect": null
      },
      {
        "question_id": "G",
        "correct": null,
        "incorrect": null
      }
    ]
  }
}
````


#### JSON Explanation:

The assessment contains its ID and a list of questions. A question has next question references for "correct" and "incorrect" fields, e.g. if the answer of question A is incorrect, then the next question will be C.


Note: ...Hmm, I am not too sure about JSON structure, it looks the way too simple and I just came up with it in 5 minutes...It could either be dict based (question_id as key) or just a pure array.

#### Back-end Logic

1. The first step is to parse the json to be object-based model. There are three models:
- Assessment: This stores assessment details e.g. assessmentId
- Question: This stores question details.
- QuestionMap: This is a map collection which formats the raw data to be a basic hash map by using question_id as key. (I used Laravel Collection as a helper function.)

2. The second step is to create an iterator which will iterate through the question list by calling getNextQuestionId. I implemented iterator inside of AssessmentProcessor class. The class implements the given interface and also keeps a state of current question ID.

Iterator example:

````php
    $service = BranchingAssessmentFactory::createAssessmentByArray($data);
    while ($currentQuestionId = $service->getNextQuestionId()) {
        $answer = rand(1, 0) === 1;
        $service->setQuestionResponse($currentQuestionId, $answer);
    }
````

3. The last step is to create a Factory which will create AssessmentProcessor based on different constructor parameters.


Note: For rules part, I initially was thinking about using Strategy design pattern, e.g. each question would bind to a list of criteria.

## Testing

1. use PHPUnit
2. use travis-ci for CI/CD: https://coveralls.io/github/RyanDaDeng/delivery-order-test?branch=master
3. tests file located at package tests file
4. test coverage is using coveralls: https://coveralls.io/github/RyanDaDeng/branching-assessment?branch=master

## Reflections & Conclusion

I think the solution is a bit overkill if you think there are too many classes for the question. 
In reality, the alternative solution could be fairly simple by manipulating array directly,however, it would encounter a lot of if-else statements which against SOLID principles.
My solution is fully based on OOP idea and following SOLID principles as much as possible.

Note: The question is a bit abstract, in real practice, I believe there can be different type of questions and the branching logic would be far more complicated.

[ico-coverage]: https://coveralls.io/repos/github/RyanDaDeng/branching-assessment/badge.svg?branch=master&service=github
[ico-build]: https://travis-ci.org/RyanDaDeng/branching-assessment.svg?branch=master
[ico-styleci]: https://github.styleci.io/repos/176903016/shield


[link-coverage]: https://coveralls.io/github/RyanDaDeng/branching-assessment?branch=master
[link-build]: https://travis-ci.org/RyanDaDeng/branching-assessment
[link-styleci]: https://github.styleci.io/repos/176903016