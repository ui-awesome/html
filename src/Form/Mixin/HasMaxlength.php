<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the `maxlength` attribute.
 *
 * @mixin HasAttributes
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/maxlength
 */
trait HasMaxlength
{
    use HasIntLikeAttribute;

    /**
     * Sets the `maxlength` attribute.
     *
     * Usage example:
     * ```php
     * $element->maxlength(50);
     * $element->maxlength(255);
     * $element->maxlength(null);
     * ```
     *
     * @param int|string|Stringable|UnitEnum|null $value Maximum length. Must be '>= 0', or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the value is not an integer-like value '>= 0'.
     *
     * @return static New instance with the updated `maxlength` attribute.
     */
    public function maxlength(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(
            Attribute::MAXLENGTH,
            self::intLikeAttribute($value, Attribute::MAXLENGTH),
        );
    }
}
