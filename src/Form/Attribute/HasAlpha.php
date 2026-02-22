<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

/**
 * Provides an immutable API for the HTML `alpha` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/color#alpha
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasAlpha
{
    /**
     * Sets the `alpha` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputColor::tag()
     *     ->alpha(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to allow the user to manipulate the color's alpha channel.
     *
     * @return static New instance with the updated `alpha` attribute.
     */
    public function alpha(bool $value): static
    {
        return $this->setAttribute('alpha', $value);
    }
}
