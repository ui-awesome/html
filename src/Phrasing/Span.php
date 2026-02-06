<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\{Inline, InlineInterface};

/**
 * Renders the HTML `<span>` element for generic inline content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Phrasing\Span::tag()
 *     ->class('highlight')
 *     ->content('Highlighted text')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/span
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Span extends BaseInline
{
    /**
     * Returns the tag enumeration for the `<span>` element.
     *
     * @return InlineInterface Tag enumeration instance for `<span>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): InlineInterface
    {
        return Inline::SPAN;
    }

    /**
     * Renders the `<span>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<span>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
