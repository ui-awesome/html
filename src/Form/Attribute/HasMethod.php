<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Form\Values\Method;
use UIAwesome\Html\Helper\Validator;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `method` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form#method
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasMethod
{
    /**
     * Sets the `method` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->method('post')
     *     ->render();
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->method(\UIAwesome\Html\Form\Values\Method::POST)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value HTTP method for form submission (`get`, `post`, or `dialog`), or `null` to
     * remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `method` attribute.
     *
     * {@see Method} for predefined enum values.
     */
    public function method(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Method::cases(), 'method');

        return $this->setAttribute('method', $value);
    }
}
