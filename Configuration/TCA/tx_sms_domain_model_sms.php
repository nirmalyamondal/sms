<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_sms',
        'label' => 'senddate',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'message',
        'iconfile' => 'EXT:sms/Resources/Public/Icons/tx_sms_domain_model_sms.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, feuser, fromsms, tosms, senddate, message',
    ],
    'types' => [
        '1' => ['showitem' => 'hidden, feuser, fromsms, tosms, senddate, message, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'feuser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_management_domain_model_product.feuser',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'foreign_table_where' => ' AND fe_users.deleted=0',
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'fromsms' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_sms.fromsms',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'tosms' => [
            'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_sms.tosms',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'fe_users',
                'foreign_table_where' => 'ORDER BY fe_users.username',
                'enableMultiSelectFilterTextfield' => true,
                'size' => 6,
                'minitems' => 1,
                'maxitems' => 50
            ]
        ],
        'senddate' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_sms.senddate',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 10,
                'eval' => 'datetime',
                'default' => time()
            ],
        ],    
        'message' => [
            'exclude' => true,
            'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_sms.message',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
    
    ],
];
