<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Embedded\Values\Preload;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `preload` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio#preload
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasPreload
{
    /**
     * Sets the `preload` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->preload(Preload::AUTO)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Preload hint (`none`, `metadata`, or `auto`), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `preload` attribute.
     *
     * {@see Preload} for predefined enum values.
     */
    public function preload(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Preload::cases(), 'preload');

        return $this->setAttribute('preload', $value);
    }
}
