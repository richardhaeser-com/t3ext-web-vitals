<?php
namespace RichardHaeser\WebVitals;

use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class ResultSaver
{
    public function render(): string
    {
        $tsfe = $this->getTypoScriptFrontendController();
        try {
            $languageAspect = $tsfe->getContext()->getAspect('language');
            $languageId = $languageAspect->getId();
        } catch (AspectNotFoundException $e) {
            $languageId = 0;
        }
        $result = json_decode(file_get_contents('php://input'));
        if (is_object($result) && is_object($result->result)) {
            $stringToHash = date('Y-m-d') . '-webvitals-' . (int)$tsfe->id;

            if (GeneralUtility::makeInstance(HashService::class)->validateHmac($stringToHash, $result->result->hash)) {
                $queryBuilderResults = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_pagespeedinsights_results')->createQueryBuilder();
                $dbEntry = $queryBuilderResults
                    ->select('*')
                    ->from('tx_webvitals_results')
                    ->where(
                        $queryBuilderResults->expr()->eq('result_id', $queryBuilderResults->createNamedParameter($result->result->id)),
                        $queryBuilderResults->expr()->eq('metric', $queryBuilderResults->createNamedParameter($result->result->name))
                    )
                    ->execute()
                    ->fetch();

                if (!$dbEntry) {
                    $queryBuilderResults
                        ->insert('tx_webvitals_results')
                        ->values([
                            'pid' => (int)$tsfe->id,
                            'sys_language_uid' => $languageId,
                            'result_id' => $result->result->id,
                            'metric' => $result->result->name,
                            'crdate' => time(),
                            'tstamp' => time(),
                            'result' => $result->result->value
                        ])
                        ->execute();
                } else {
                    $queryBuilderResults
                        ->update('tx_webvitals_results')
                        ->set('tstamp', time())
                        ->set('result', $result->result->value)
                        ->where(
                            $queryBuilderResults->expr()->eq('result_id', $queryBuilderResults->createNamedParameter($result->result->id)),
                            $queryBuilderResults->expr()->eq('metric', $queryBuilderResults->createNamedParameter($result->result->name))
                        )
                        ->execute();
                }
                $returnValue = ['status' => 'success'];
            } else {
                $returnValue = ['status' => 'error', 'errorMessage' => 'Invalid hash'];
            }
        } else {
            $returnValue = ['status' => 'error', 'errorMessage' => 'Not a valid result'];
        }

        return json_encode($returnValue);
    }

    protected function getTypoScriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }
}
