<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;

/**
 * Renders the HTML `<strong>` element for text of strong importance.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Phrasing\Strong::tag()
 *     ->class('important')
 *     ->content('Warning')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/strong
 * {@see BaseInline} for the base implementation.
 */
final class Strong extends BaseInline
{
    /**
     * Returns the tag enumeration for the `<strong>` element.
     *
     * @return Inline Tag enumeration instance for `<strong>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::STRONG;
    }

    /**
     * Renders the `<strong>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<strong>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
