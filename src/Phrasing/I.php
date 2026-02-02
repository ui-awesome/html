<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\{Inline, InlineInterface};

/**
 * Represents the HTML `<i>` element for idiomatic text.
 *
 * Provides a concrete `<i>` element implementation that returns `Inline::I` and inherits inline-level rendering and
 * global attribute support from {@see BaseInline}.
 *
 * The `<i>` element represents a range of text that is set off from the normal text for some reason, such as idiomatic
 * text, technical terms, taxonomical designations, among others. Historically, these have been presented using
 * italicized type, which is the original source of the `<i>` naming of this element.
 *
 * Key features.
 * - Inline element accepts child content.
 * - Supports global HTML attributes via {@see BaseInline}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Flow\I;
 *
 * echo I::tag()
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
