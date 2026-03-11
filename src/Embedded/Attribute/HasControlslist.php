<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Embedded\Values\Controlslist;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

use function is_string;

/**
 * Provides an immutable API for the HTML `controlslist` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio#controlslist
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasControlslist
{
    /**
     * Sets the `controlslist` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->controlslist(Controlslist::nodownload)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Controls list token, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `controlslist` attribute.
     *
     * {@see Controlslist} for predefined enum values.
     */
    public function controlslist(string|UnitEnum|null $value): static
    {
        return $this->setAttribute('controlslist', $value);
    }
}
