<?php
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:example_extension/Configuration/PageTSconfig/example_extension.ts">'
);
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][\exampleextension\exampleextension\Form\FormDataProvider\TcaColPosItem::class] = [
    'depends' => [
        \TYPO3\CMS\Backend\Form\FormDataProvider\TcaSelectItems::class,
    ],
];