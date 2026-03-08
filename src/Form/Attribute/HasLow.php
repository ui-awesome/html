<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

/**
 * Provides an immutable API for the HTML `low` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meter#low
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasLow
{
    /**
     * Sets the `low` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Meter::tag()
     *     ->low(33)
     *     ->render();
     * ```
     *
     * @param float|int|string|null $value Upper numeric bound of the low end of the measured range, or `null` to remove
     * the attribute.
     *
     * @return static New instance with the updated `low` attribute.
     */
    public function low(float|int|string|null $value): static
    {
        return $this->setAttribute('low', $value);
    }
}
