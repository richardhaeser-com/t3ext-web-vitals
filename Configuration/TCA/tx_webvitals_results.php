<?php
$llPrefix = 'LLL:EXT:webvitals/Resources/Private/Language/locallang_tca.xlf:';

return [
    'ctrl' => [
        'title' => $llPrefix . 'tx_webvitals_results.title',
        'label' => 'crdate',
        'label_alt' => 'metric,result',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'sortby' => 'tstamp desc',
        'iconfile' => 'EXT:webvitals/Resources/Public/Icons/Extension.svg',
        'delete' => 'deleted',
        'versioningWS' => true,
    ],
    'columns' => [
        'crdate' => [
            'exclude' => true,
            'label' => $llPrefix . 'tx_webvitals_results.date',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'readOnly' => true,
                'eval' => 'datetime,trim'
            ]
        ],
        'metric' => [
            'exclude' => true,
            'label' => $llPrefix . 'tx_webvitals_results.metric',
            'config' => [
                'type' => 'input',
                'readOnly' => true,
                'eval' => 'trim'
            ]
        ],
        'result_id' => [
            'exclude' => true,
            'label' => $llPrefix . 'tx_webvitals_results.result_id',
            'config' => [
                'type' => 'input',
                'readOnly' => true,
                'eval' => 'trim'
            ]
        ],
        'result' => [
            'exclude' => true,
            'label' => $llPrefix . 'tx_webvitals_results.result',
            'config' => [
                'type' => 'input',
                'readOnly' => true,
                'eval' => 'trim'
            ]
        ],
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0]
                ],
                'default' => 0,
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => false,
                    ],
                ],
            ]
        ],
    ],
    'palettes' => [
        'general' => [
            'showitem' => 'crdate, result_id'
        ],
        'score' => [
            'showitem' => 'metric, result'
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;' . $llPrefix . 'tx_webvitals_results.tab.results,
                    --palette--;;general,
                    --palette--;;score,
                --div--;' . $llPrefix . 'tx_webvitals_results.tab.language,
                    sys_language_uid,
            '
        ]
    ],
];
