<?php
defined('TYPO3_MODE') or die();

// ATTENTION: this is need for standalone CE with inline-content (fixes bug if gridelements is installed)
// borrowed from EXT:mask:
// if there is already a itemsProcFunc in the tt_content colPos tca, save it to another key for later usage
if (!empty($GLOBALS['TCA']['tt_content']['columns']['colPos']['config']['itemsProcFunc'])) {
    $GLOBALS['TCA']['tt_content']['columns']['colPos']['config']['bt_itemsProcFunc'] = $GLOBALS['TCA']['tt_content']['columns']['colPos']['config']['itemsProcFunc'];
}
// if there is already a itemsProcFunc in the tt_content CType tca, save it to another key for later usage
if (!empty($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['itemsProcFunc'])) {
    $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['bt_itemsProcFunc'] = $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['itemsProcFunc'];
}
// and set mask itemsProcFuncs
$GLOBALS['TCA']['tt_content']['columns']['colPos']['config']['itemsProcFunc'] = 'EXAMPLEEXTENSION\ExampleExtension\ItemsProcFuncs\ColPosList->itemsProcFunc';
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['itemsProcFunc'] = 'EXAMPLEEXTENSION\ExampleExtension\ItemsProcFuncs\CTypeList->itemsProcFunc';



$tempColumns = array (
    'tx_exampleextension_containercontent_foreign' =>
        array (
            'config' =>
                array (
                    'type' => 'inline',
                    'foreign_table' => 'tt_content',
                    'foreign_record_defaults' =>
                        array (
                            'colPos' => '999',
                            'CType' => 'table', // this just sets the default CType but does NOT restrict select list!
                        ),
                    'foreign_sortby' => 'sorting',
                    'appearance' =>
                        array (
                            'collapseAll' => '1',
                            'levelLinksPosition' => 'top',
                            'showSynchronizationLink' => '1',
                            'showPossibleLocalizationRecords' => '1',
                            'showAllLocalizationLink' => '1',
                            'useSortable' => '1',
                            'enabledControls' =>
                                array (
                                    'dragdrop' => '1',
                                ),
                            'newRecordLinkTitle' => 'neues Kind-Element erstellen',
                        ),
                    'maxitems' => '99',
                    'behaviour' =>
                        array (
                            'localizationMode' => 'select',
                        ),
                    'foreign_field' => 'tx_exampleextension_containercontent_foreign_parent',
                ),
            'exclude' => '1',
            'label' => 'LLL:EXT:example_extension/Resources/Private/Language/locallang_db.xlf:tt_content.tx_exampleextension_containercontent_foreign',
        ),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);



$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = array(
    'LLL:EXT:example_extension/Resources/Private/Language/locallang_db.xlf:tt_content.CType.exampleextension_containerce',
    'exampleextension_containerce',
);
$tempTypes = array (
  'exampleextension_containerce' =>
  array (
    'showitem' => '
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            header,
            header_layout,
            tx_exampleextension_containercontent_foreign,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
        --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,categories, 
        tx_gridelements_container, 
        tx_gridelements_columns',
  ),
);
$GLOBALS['TCA']['tt_content']['types'] += $tempTypes;
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'example_extension',
    'Configuration/TypoScript/',
    'example_extension'
);
