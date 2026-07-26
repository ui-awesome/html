<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the `minlength` attribute.
 *
 * @mixin HasAttributes
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/minlength
 */
trait HasMinlength
{
    use HasIntLikeAttribute;

    /**
     * Sets the `minlength` attribute.
     *
     * Usage example:
     * ```php
     * $element->minlength(3);
     * $element->minlength(8);
     * $element->minlength(null);
     * ```
     *
     * @param int|string|Stringable|UnitEnum|null $value Minimum length. Must be '>= 0', or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the value is not an integer-like value '>= 0'.
     *
     * @return static New instance with the updated `minlength` attribute.
     */
    public function minlength(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(
            Attribute::MINLENGTH,
            self::intLikeAttribute($value, Attribute::MINLENGTH),
        );
    }
}
