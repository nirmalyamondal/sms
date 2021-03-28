<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'AshokaTree.Sms',
            'Pi1',
            'SMS Management'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('sms', 'Configuration/TypoScript', 'Short Message Service');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sms_domain_model_sms', 'EXT:sms/Resources/Private/Language/locallang_csh_tx_sms_domain_model_sms.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sms_domain_model_sms');

    }
);
