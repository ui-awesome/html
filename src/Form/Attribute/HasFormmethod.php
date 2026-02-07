<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `formmethod` attribute.
 *
 * @method static addAttribute(string|UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/formmethod
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasFormmethod
{
    /**
     * Sets the `formmethod` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputSubmit::tag()->formmethod('post')->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value HTTP method for form submission, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `formmethod` attribute.
     */
    public function formmethod(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('formmethod', $value);
    }
}
