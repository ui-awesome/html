<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;

/**
 * Renders the HTML `<code>` element for inline code fragments.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Phrasing\Code::tag()
 *     ->class('inline-code')
 *     ->content('echo $value;')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/code
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Code extends BaseInline
{
    /**
     * Returns the tag enumeration for the `<code>` element.
     *
     * @return Inline Tag enumeration instance for `<code>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::CODE;
    }

    /**
     * Renders the `<code>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<code>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
