# Branching Assessment

[![Coverage Status][ico-coverage]][link-coverage]
[![Build][ico-build]][link-build]
[![StyleCI][ico-styleci]][link-styleci]



## Description

The solution is written on Laravel framework.

## Requirement

1. Laravel >=5.5
2. PHP >= 7.0

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

// client side
 $service = BranchingAssessmentFactory::createAssessmentByArray($data);
 
 $service->getNextQuestionId() // first time get fist question
 
 $service->setQuestionResponse($questionId, $isCorrect);
 
 // AssessmentProcessor factory
 $service = BranchingAssessmentFactory::createAssessmentByArray($data); // create service entry
 
 // Rule factory
 RuleFactory::process(new AssessmentProcessor($json)) // rule processor
 
 
 
````

## Design Keywords

- OOP: polymorphism
- OOP: inheritance
- OOP: encapsulation
- Strategy design pattern
- Iterator design pattern
- Factory design pattern

Above design patterns might be slightly improved according to the assessment's requirement.

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

## Suggestions

I highly suggest you to run the two commands to play with the system first before diving into the code.


## Solution


#### Designs


The JSON sample object from the assessment example:

````
{
   "assessment_id":"1",
   "questions":[
      {
         "question_id":"A",
         "rule":{
            "type":"simple_skip_rule",
            "correct":"C",
            "incorrect":"B"
         }
      },
      {
         "question_id":"C",
         "rule":{
            "type":"simple_skip_rule",
            "correct":"E",
            "incorrect":"F"
         }
      },
      {
         "question_id":"B",
         "rule":{
            "type":"simple_skip_rule",
            "correct":"D",
            "incorrect":"D"
         }
      },
      {
         "question_id":"D",
         "rule":{
            "type":"simple_skip_rule",
            "correct":"C",
            "incorrect":"C"
         }
      },
      {
         "question_id":"E",
         "rule":{
            "type":"simple_skip_rule",
            "correct":"G",
            "incorrect":"G"
         }
      },
      {
         "question_id":"F",
         "rule":{
            "type":"simple_skip_rule",
            "correct":"H",
            "incorrect":"H"
         }
      },
      {
         "question_id":"H",
         "rule":{
            "type":"simple_skip_rule",
            "correct":"G",
            "incorrect":null
         }
      },
      {
         "question_id":"G",
         "rule":{
            "type":"simple_skip_rule",
            "correct":null,
            "incorrect":null
         }
      }
   ]
}
````

#### Rule

Currently, the solution contains two different type of rules as below: (its pretty easy to add a new rule without modifying any core code.)

##### Simple Skip rule:


````

{
....
    'question_id': 'C',
    'rule' :{
        'type' : 'simple_skip_rule',
        'correct' => 'A',
        'incorrect' => 'B'
    }
....     
}

````
Explanation: If the answer is correct, it goes to A, if the answer is incorrect, it goes to B.


##### Score Check rule:


````

{
....
    'question_id': 'A',
    'rule' :{
         'type' : 'score_check_rule',
          'threshold' : 2,
          'next': 'E',
          'default': 'F'
    }
....     
}

````

Explanation: If the current score is 2 (include the result of question A), and the score >= 2, it goes to E else goes to F.


##### Strategy Pattern - Rule Design

The rule design follows Strategy pattern (OOP: polymorphism), which means all the core logic has been encapsulated in AssessmentProcessor, and what you do is just to create a new strategy by extending AbstractRule class (the class implements RuleInterface).

This ensures any skip/branching logic can be freely added to the logic without touching any core code.


#### Factory Pattern - Rule creations and AssessmentProcessor creations

- AssessmentProcessorFactory is used to create AssessmentProcessor based on different constructor parameters.
- RuleFactory is used to create different rule strategy by passing the AssessmentProcessor class.

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

3. The third step is to check current question's rule by using RuleFactory to create a rule processor in which will return a next question ID.


## Testing

1. use PHPUnit to cover all essential classes and cases.
2. use travis-ci for CI/CD:https://travis-ci.org/RyanDaDeng/branching-assessment
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
