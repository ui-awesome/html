<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\{Inline, InlineInterface};

/**
 * Renders the HTML `<i>` element for alternate voice or idiomatic text.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Phrasing\I::tag()
 *     ->class('technical-term')
 *     ->content('Veni, vidi, vici')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/i
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class I extends BaseInline
{
    /**
     * Returns the tag enumeration for the `<i>` element.
     *
     * @return InlineInterface Tag enumeration instance for `<i>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): InlineInterface
    {
        return Inline::I;
    }

    /**
     * Renders the `<i>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<i>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
