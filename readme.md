# DeliveryOrderTest

[![Coverage Status][ico-coverage]][link-coverage]
[![Build][ico-build]][link-build]
[![StyleCI][ico-styleci]][link-styleci]



## Description

The solution is written on Laravel framework.

## Installation

1. This is a Laravel composer package, you need to have a Laravel installed first.
2. Via Composer

``` bash
$ composer require timehunter/delivery-order-test v1.0.0
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

The assessment contains its ID and a list of question. A question has next question references on "correct" and "incorrect" field, e.g. if the answer of question A is incorrect, then the next question will be C.


#### Back-end Logic

1. The first step is to parse the json to be object-based model. There are three models:
- Assessment: This stores assessment details e.g. assessmentId
- Question: This stores question details
- QuestionMap: This is a map collection which formats the raw data to be a basic hash map by using question_id as key. (I used Laravel Collection as a helper function.)

2. The second step is to create a iterator which will iterate through the question list by calling getNextQuestionId. I implemented iterator inside of AssessmentProcessor class. The class implements the given interface and also keeps a state of current question ID.

3. The last step is to create a Factory which will create AssessmentProcessor based on different constructor parameters as a correctional helper class.


## Testing

1. use PHPUnit
2. use travis-ci for CI/CD: https://coveralls.io/github/RyanDaDeng/delivery-order-test?branch=master
3. tests file located at package tests file
4. test coverage is using coveralls

[ico-coverage]: https://coveralls.io/repos/github/RyanDaDeng/branching-assessment/badge.svg?branch=master&service=github
[ico-build]: https://travis-ci.org/RyanDaDeng/branching-assessment.svg?branch=master
[ico-styleci]: https://github.styleci.io/repos/174629501/shield


[link-coverage]: https://coveralls.io/github/RyanDaDeng/branching-assessment?branch=master
[link-build]: https://travis-ci.org/RyanDaDeng/branching-assessment
[link-styleci]: https://github.styleci.io/repos/174629501