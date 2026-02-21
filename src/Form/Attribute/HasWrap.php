<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Form\Values\Wrap;
use UIAwesome\Html\Helper\Validator;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `wrap` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/textarea#wrap
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasWrap
{
    /**
     * Sets the `wrap` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\TextArea::tag()
     *     ->wrap('hard')
     *     ->render();
     * echo \UIAwesome\Html\Form\TextArea::tag()
     *     ->wrap(\UIAwesome\Html\Form\Values\Wrap::SOFT)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Line-wrapping behavior (`hard`, `soft`, or `off`), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `wrap` attribute.
     *
     * {@see Wrap} for predefined enum values.
     */
    public function wrap(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Wrap::cases(), 'wrap');

        return $this->setAttribute('wrap', $value);
    }
}
