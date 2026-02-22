<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `accept-charset` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form#accept-charset
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasAcceptCharset
{
    /**
     * Sets the `accept-charset` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->acceptCharset('UTF-8')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Character encoding for form submission, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `accept-charset` attribute.
     */
    public function acceptCharset(string|Stringable|UnitEnum|null $value): static
    {
        return $this->setAttribute('accept-charset', $value);
    }
}
