<?php
namespace RichardHaeser\WebVitals\Hooks;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class PageRendererPreProcess implements SingletonInterface
{
    /**
     * @var ContentObjectRenderer
     */
    private $cObj;

    public function __construct()
    {
        $this->cObj = GeneralUtility::makeInstance(ContentObjectRenderer::class);
    }

    /**
     * @param array $params
     * @param object $pObj
     */
    public function render(array &$params, PageRenderer $pObj)
    {
        if (TYPO3_MODE !== 'FE' || !(bool)$GLOBALS['TSFE']->page['tx_pagespeedinsights_check']) {
            return '';
        }

        $conf = [
            'parameter' => '&type=1616226116',
            'forceAbsoluteUrl' => true
        ];
        $url = $this->cObj->typoLink_URL($conf);

        $stringToHash = date('Y-m-d') . '-webvitals-' . (int)$GLOBALS['TSFE']->id;
        $hash = GeneralUtility::makeInstance(HashService::class)->generateHmac($stringToHash);
        $pObj->addJsInlineCode('webvitals', 'var webvitalsAnalyticsUrl = "' . $url . '"; var webvitalsHash = "' . $hash . '"');
        $pObj->addJsFooterFile('EXT:webvitals/Resources/Public/Build/runtime.js', 'text/javascript', false, false, '', true, '|', false, '', true);
        $pObj->addJsFooterFile('EXT:webvitals/Resources/Public/Build/frontend-js.js', 'text/javascript', false, false, '', true, '|', false, '', true);
        $pObj->addJsFile('EXT:webvitals/Resources/Public/Build/polyfill.js', 'text/javascript', false, false, '', true);
    }
}