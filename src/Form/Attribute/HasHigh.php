<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `high` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meter#high
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasHigh
{
    /**
     * Sets the `high` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Meter::tag()
     *     ->high(66)
     *     ->render();
     * ```
     *
     * @param float|int|string|null $value Lower numeric bound of the high end of the measured range, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `high` attribute.
     */
    public function high(float|int|string|null $value): static
    {
        return $this->setAttribute('high', $value);
    }
}
