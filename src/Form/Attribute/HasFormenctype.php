<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `formenctype` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/formenctype
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasFormenctype
{
    /**
     * Sets the `formenctype` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputSubmit::tag()->formenctype('multipart/form-data')->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Encoding type for form submission, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `formenctype` attribute.
     */
    public function formenctype(string|Stringable|UnitEnum|null $value): static
    {
        return $this->setAttribute('formenctype', $value);
    }
}
