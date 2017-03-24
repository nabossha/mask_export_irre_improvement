<?php

namespace EXAMPLEEXTENSION\ExampleExtension\ItemsProcFuncs;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Nando Bosshart <nando@bosshartong.ch>, BossharTong GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * Checks and renders the allowed CTypes for nested content elements exported via mask_export
 * @author Nando Bosshart <nando@bosshartong.ch>>
 */
class CTypeList extends AbstractList
{

    /**
     * Checks and renders the allowed CTypes for nested content elements (created via mask_export)
     * @param array $params
     */
    public function itemsProcFunc(&$params)
    {
        // Load page TSconfig:
        $pageTSconfig = BackendUtility::getPagesTSconfig($pid);

        // ATTENTION: the name of CE-key may change:
        $elementConfig = $pageTSconfig['tx_exampleextension_containerce.']['config.'];
        $allowedCTypes = explode(',',$elementConfig['allowed']);

        // if this tt_content element is inline element:
        if ($params["row"]["colPos"] == $this->colPos) {
            if ((int)$params['row']['pid'] > 0) {

                // if there is a restriction of cTypes specified
                if (is_array($allowedCTypes)) {

                    // borrowed from EXT:mask:
                    // prepare array of allowed cTypes, with cTypes as keys
                    $cTypes = array_flip($allowedCTypes);
                    // and check each item if it is allowed. if not, unset it
                    foreach ($params["items"] as $itemKey => $item) {
                        if (!isset($cTypes[$item[1]])) {
                            unset($params["items"][$itemKey]);
                        }
                    }
                }
            }

        } else { // if it is not inline tt_content element
            // and if other itemsProcFunc from other extension was available (e.g. gridelements),
            // then call it now and let it render the items
            if (!empty($params["config"]["bt_itemsProcFunc"])) {
                \TYPO3\CMS\Core\Utility\GeneralUtility::callUserFunction($params["config"]["bt_itemsProcFunc"], $params, $this);
            }
        }
    }
}
