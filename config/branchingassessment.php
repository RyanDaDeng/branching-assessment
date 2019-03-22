<?php

return [
    /*
     *  'your_assessment_name' => [...]
     */
    'provided_assessment' => [
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
    ],
    'score_rule_assessment' => [
        'assessment_id' => '2',
        'questions' => [
            [
                'question_id' => 'A',
                'rule' => [
                    'type' => 'simple_skip_rule',
                    'correct' => 'C',
                    'incorrect' => 'C'
                ]
            ],
            [
                'question_id' => 'C',
                'rule' => [
                    'type' => 'score_check_rule',
                    'threshold' => 2,
                    'next' => 'E',
                    'default' => 'F'
                ]
            ],
            [
                'question_id' => 'E',
                'rule' => [
                    'type' => 'simple_skip_rule',
                    'correct' => null,
                    'incorrect' => null
                ]
            ],
            [
                'question_id' => 'F',
                'rule' => [
                    'type' => 'simple_skip_rule',
                    'correct' => null,
                    'incorrect' => null
                ]
            ]
        ],
    ]
];
