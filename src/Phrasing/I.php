<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;

/**
 * Renders the HTML `<i>` element for alternate voice or idiomatic text.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/i
 * {@see BaseInline} for the base implementation.
 */
final class I extends BaseInline
{
    /**
     * Returns the tag enumeration for the `<i>` element.
     *
     * @return Inline Tag enumeration instance for `<i>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
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
