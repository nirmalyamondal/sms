<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'AshokaTree.Sms',
            'Pi1',
            [
                'Message' => 'new,create,list,detail,edit,update,delete'
            ],
            // non-cacheable actions
            [
                'Message' => 'new,create,list,detail,edit,update,delete'
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        pi1 {
                            iconIdentifier = sms-plugin-pi1
                            title = LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_pi1.name
                            description = LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_pi1.description
                            tt_content_defValues {
                                CType = list
                                list_type = sms_pi1
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'sms-plugin-pi1',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:sms/Resources/Public/Icons/user_plugin_pi1.svg']
			);
		
    }
);
