<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\{Inline, InlineInterface};

/**
 * Represents the HTML `<span>` element for grouping inline content.
 *
 * Provides a concrete `<span>` element implementation that returns `Inline::SPAN` and inherits inline-level rendering
 * and global attribute support from {@see BaseInline}.
 *
 * The `<span>` element is a generic inline container for phrasing content, which does not inherently represent
 * anything. It should be used only when no other semantic element is appropriate.
 *
 * Key features.
 * - Inline element accepts child content.
 * - Supports global HTML attributes via {@see BaseInline}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Flow\Span;
 *
 * echo Span::tag()
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
