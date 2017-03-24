tx_exampleextension_containerce {
    config {
        // comma-separated list of allowed CEs for inline-content:
        allowed = table,uploads
    }
}


mod.wizards.newContentElement.wizardItems.common {
    elements {
        containerce {
                iconIdentifier = content-special-menu
                title = LLL:EXT:example_extension/Resources/Private/Language/locallang_db_new_content_el.xlf:wizards.newContentElement.menubadges_title
                description = LLL:EXT:example_extension/Resources/Private/Language/locallang_db_new_content_el.xlf:wizards.newContentElement.menubadges_description
                tt_content_defValues {
                    CType = exampleextension_containerce
                }
            }
    }
    show := addToList(containerce)
}
