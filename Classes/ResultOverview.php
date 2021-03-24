<?php
namespace RichardHaeser\WebVitals;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

class ResultOverview
{
    protected static $boundaries = [
        'CLS' => ['good' => 0.1, 'improvement' => 0.25],
        'FID' => ['good' => 100, 'improvement' => 300],
        'LCP' => ['good' => 2500, 'improvement' => 4000],
    ];

    public static function render(int $pageId, int $languageId = 0): string
    {
        $templateView = GeneralUtility::makeInstance(StandaloneView::class);
        $templateView->getRenderingContext()->getTemplatePaths()->fillDefaultsByPackageName('webvitals');
        $templateView->setTemplate('Result');

        $clsData = self::getData('CLS', $pageId, $languageId);
        $fidData = self::getData('FID', $pageId, $languageId);
        $lcpData = self::getData('LCP', $pageId, $languageId);
        $passCoreWebVitals = false;
        if ($clsData['score'] === 'good' && $fidData['score'] === 'good' && $lcpData['score'] === 'good') {
            $passCoreWebVitals = true;
        }
        $totalNumberOfResults = (int)$clsData['numberOfResults'] + (int)$fidData['numberOfResults'] + (int)$lcpData['numberOfResults'];

        $templateView->assignMultiple([
            'passCoreWebVitals' => $passCoreWebVitals,
            'totalNumberOfResults' => $totalNumberOfResults,
            'cls' => $clsData,
            'fid' => $fidData,
            'lcp' => $lcpData
        ]);

        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addCssFile('EXT:webvitals/Resources/Public/Build/backend-css.css');
        return $templateView->render();
    }

    protected static function getData(string $metric, int $pageId, int $languageId): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_webvitals_results');

        $constraints = [];
        if ($pageId > 0) {
            $constraints[] = $queryBuilder->expr()->eq('pid', $pageId);
        }
        $startDate = new \DateTime();
        $startDate->modify('-28 days');

        $constraints[] = $queryBuilder->expr()->eq('metric', $queryBuilder->createNamedParameter($metric));
        $constraints[] = $queryBuilder->expr()->eq('sys_language_uid', $languageId);
        $constraints[] = $queryBuilder->expr()->gte('crdate', $startDate->getTimestamp());
        $results = $queryBuilder
            ->select('*')
            ->from('tx_webvitals_results')
            ->where(...$constraints)
            ->orderBy('crdate', 'DESC')
            ->execute()
            ->fetchAll();

        $data = ['good' => 0, 'improvement' => 0, 'poor' => 0];
        $resultItems = 0;
        $resultTotal = 0;
        foreach ($results as $result) {
            if ($result['result'] <= self::$boundaries[$metric]['good']) {
                $data['good']++;
            } elseif ($result['result'] <= self::$boundaries[$metric]['improvement']) {
                $data['improvement']++;
            } else {
                $data['poor']++;
            }
            $resultTotal += $result['result'];
            $resultItems++;
        }

        if (!empty($resultItems)) {
            $data['average'] = ($resultTotal / $resultItems);
            if ($data['average'] <= self::$boundaries[$metric]['good']) {
                $data['score'] = 'good';
            } elseif ($data['average'] <= self::$boundaries[$metric]['improvement']) {
                $data['score'] = 'improvement';
            } else {
                $data['score'] = 'poor';
            }

            $data['percentage']['good'] = self::formatPercentage(100 * $data['good'] / $resultItems);
            $data['percentage']['improvement'] = self::formatPercentage(100 * $data['improvement'] / $resultItems);
            $data['percentage']['poor'] = self::formatPercentage(100 * $data['poor'] / $resultItems);
        }

        $data['numberOfResults'] = $resultItems;
        return $data;
    }

    protected static function formatPercentage($number): string
    {
        $number = number_format($number, 1);
        return preg_replace('/.0$/', '', $number);
    }
}