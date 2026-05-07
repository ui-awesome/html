<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;

/**
 * Renders the HTML `<small>` element for side comments and small print.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Phrasing\Small::tag()
 *     ->class('fine-print')
 *     ->content('Terms apply')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/small
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Small extends BaseInline
{
    /**
     * Returns the tag enumeration for the `<small>` element.
     *
     * @return Inline Tag enumeration instance for `<small>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::SMALL;
    }

    /**
     * Renders the `<small>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<small>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
