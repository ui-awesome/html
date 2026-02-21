<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Form\Values\Colorspace;
use UIAwesome\Html\Helper\Validator;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `colorspace` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/color#colorspace
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasColorspace
{
    /**
     * Sets the `colorspace` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputColor::tag()
     *     ->colorspace(\UIAwesome\Html\Form\Values\Colorspace::DISPLAY_P3)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Color space (`limited-srgb` or `display-p3`), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `colorspace` attribute.
     *
     * {@see Colorspace} for predefined enum values.
     */
    public function colorspace(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Colorspace::cases(), 'colorspace');

        return $this->setAttribute('colorspace', $value);
    }
}
