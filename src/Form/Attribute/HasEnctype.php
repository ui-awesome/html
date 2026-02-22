<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Form\Values\Enctype;
use UIAwesome\Html\Helper\Validator;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `enctype` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form#enctype
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasEnctype
{
    /**
     * Sets the `enctype` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->enctype('multipart/form-data')
     *     ->render();
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->enctype(\UIAwesome\Html\Form\Values\Enctype::MULTIPART_FORM_DATA)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value MIME type for form submission (`application/x-www-form-urlencoded`,
     * `multipart/form-data`, or `text/plain`), or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `enctype` attribute.
     *
     * {@see Enctype} for predefined enum values.
     */
    public function enctype(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Enctype::cases(), 'enctype');

        return $this->setAttribute('enctype', $value);
    }
}
