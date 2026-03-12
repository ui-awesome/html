<?php

declare(strict_types=1);

namespace UIAwesome\Html\Interactive\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interactive\Values\Closedby;
use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `closedby` attribute.
 *
 * Experimental HTML attribute. Availability and behavior may vary across browsers.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dialog#closedby
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasClosedby
{
    /**
     * Sets the `closedby` attribute.
     *
     * Usage example:
     * ```php
     * use UIAwesome\Html\Interactive\Dialog;
     * use UIAwesome\Html\Interactive\Values\Closedby;
     *
     * echo Dialog::tag()
     *     ->closedby(Closedby::CLOSEREQUEST)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Dialog close policy (`any`, `closerequest`, `none`), or `null` to remove
     * the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `closedby` attribute.
     *
     * {@see Closedby} for predefined enum values.
     */
    public function closedby(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Closedby::cases(), 'closedby');

        return $this->setAttribute('closedby', $value);
    }
}
