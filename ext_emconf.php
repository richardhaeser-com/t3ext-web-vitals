<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Web Vitals',
    'description' => '',
    'category' => 'frontend',
    'author' => 'Richard Haeser',
    'author_email' => 'richard@richardhaeser.com',
    'author_company' => 'richardhaeser.com',
    'state' => 'stable',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-',
            'page_speed_insights' => ''
        ],
        'conflicts' => [
        ],
        'suggests' => [
            'dashboard' => ''
        ],
    ],
];
