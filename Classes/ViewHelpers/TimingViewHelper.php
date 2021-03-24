<?php

namespace RichardHaeser\WebVitals\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class TimingViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Output is escaped already. We must not escape children, to avoid double encoding.
     *
     * @var bool
     */
    protected $escapeChildren = false;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        $this->registerArgument('decimals', 'int', '', false, 2);
        $this->registerArgument('humanReadableTime', 'bool', '', false, false);
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $floatToFormat = $renderChildrenClosure();
        if (empty($floatToFormat)) {
            $floatToFormat = 0.0;
        } else {
            $floatToFormat = (float)$floatToFormat;
        }
        $suffix = '';
        if ($arguments['humanReadableTime']) {
            if ($floatToFormat > 1000) {
                $floatToFormat /= 1000;
                $suffix = ' s';
            } else {
                $suffix = ' ms';
            }
        }
        return number_format($floatToFormat, $arguments['decimals'], ',', '.') . $suffix;
    }
}
