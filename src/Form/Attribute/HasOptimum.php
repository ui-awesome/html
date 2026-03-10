<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `optimum` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meter#optimum
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasOptimum
{
    /**
     * Sets the `optimum` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Meter::tag()
     *     ->optimum(80)
     *     ->render();
     * ```
     *
     * @param float|int|string|null $value Optimal numeric value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `optimum` attribute.
     */
    public function optimum(float|int|string|null $value): static
    {
        return $this->setAttribute('optimum', $value);
    }
}
