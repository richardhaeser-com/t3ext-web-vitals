<?php
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][]
    = \RichardHaeser\WebVitals\Hooks\PageRendererPreProcess::class . '->render';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
    'WebVitals',
    'setup',
    '<INCLUDE_TYPOSCRIPT: source="FILE: EXT:webvitals/Configuration/TypoScript/setup.typoscript">'
);
