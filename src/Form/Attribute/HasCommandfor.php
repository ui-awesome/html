<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `commandfor` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/button#commandfor
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasCommandfor
{
    /**
     * Sets the `commandfor` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Button::tag()
     *     ->commandfor('my-dialog')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value ID of the element to control, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `commandfor` attribute.
     */
    public function commandfor(string|Stringable|UnitEnum|null $value): static
    {
        return $this->setAttribute('commandfor', $value);
    }
}
