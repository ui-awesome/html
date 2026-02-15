<?php

declare(strict_types=1);

namespace UIAwesome\Html\List\Attribute;

/**
 * Provides an immutable API for the HTML `reversed` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/ol#reversed
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasReversed
{
    /**
     * Sets the `reversed` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\List\Ol::tag()->reversed(true)->render();
     * ```
     *
     * @param bool $value Whether the list items are numbered in reverse order.
     *
     * @return static New instance with the updated `reversed` attribute.
     */
    public function reversed(bool $value): static
    {
        return $this->setAttribute('reversed', $value);
    }
}
