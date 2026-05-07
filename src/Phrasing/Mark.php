<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;

/**
 * Renders the HTML `<mark>` element for highlighted reference text.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Phrasing\Mark::tag()
 *     ->class('match')
 *     ->content('search term')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/mark
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Mark extends BaseInline
{
    /**
     * Returns the tag enumeration for the `<mark>` element.
     *
     * @return Inline Tag enumeration instance for `<mark>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::MARK;
    }

    /**
     * Renders the `<mark>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<mark>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
