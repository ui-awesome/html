<?php

declare(strict_types=1);

namespace UIAwesome\Html\Interactive\Attribute;

/**
 * Provides an immutable API for the `open` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/details#open
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait CanBeOpen
{
    /**
     * Sets the `open` attribute.
     *
     * Usage example:
     * ```php
     * $element->open(true);
     * $element->open(null);
     * ```
     *
     * @param bool|null $value Open state. Use `true` to show details, `false` to hide, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `open` attribute.
     */
    public function open(bool|null $value): static
    {
        return $this->setAttribute('open', $value);
    }
}
