<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;

/**
 * Renders the HTML `<em>` element for stress emphasis.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Phrasing\Em::tag()
 *     ->class('emphasis')
 *     ->content('really')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/em
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Em extends BaseInline
{
    /**
     * Returns the tag enumeration for the `<em>` element.
     *
     * @return Inline Tag enumeration instance for `<em>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::EM;
    }

    /**
     * Renders the `<em>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<em>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
