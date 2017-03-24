<?php
namespace EXAMPLEEXTENSION\ExampleExtension\Form\FormDataProvider;

use TYPO3\CMS\Backend\Form\FormDataProviderInterface;
use TYPO3\CMS\Lang\LanguageService;

class TcaColPosItem implements FormDataProviderInterface
{
    /**
     * @param array $result
     * @return array
     */
    public function addData(array $result)
    {
        if (empty($result['inlineParentConfig']['foreign_record_defaults']['colPos']) ||
            '999' !== $result['inlineParentConfig']['foreign_record_defaults']['colPos']
        ) {
            return $result;
        }

        $result['processedTca']['columns']['colPos']['config']['items'][0][0] = $this->getLanguageService()->sL('LLL:EXT:example_extension/Resources/Private/Language/locallang_db.xlf:tt_content.colPos.nestedContentColPos');

        return $result;
    }

    /**
     * @return LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}