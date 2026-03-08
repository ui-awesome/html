<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{HasMax, HasMin};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Form\Attribute\{HasHigh, HasLow, HasOptimum};
use UIAwesome\Html\Interop\Inline;

/**
 * Renders the HTML `<meter>` element for scalar measurements within a known range, such as disk usage or the relevance
 * of a search result.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Meter::tag()
 *     ->content('at 50/100')
 *     ->high(66)
 *     ->low(33)
 *     ->max(100)
 *     ->min(0)
 *     ->optimum(80)
 *     ->value(50)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/meter
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Meter extends BaseInline
{
    use HasHigh;
    use HasLow;
    use HasMax;
    use HasMin;
    use HasOptimum;
    use HasValue;

    /**
     * Returns the tag enumeration for the `<meter>` element.
     *
     * @return Inline Tag enumeration instance for `<meter>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::METER;
    }

    /**
     * Renders the `<meter>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<meter>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
