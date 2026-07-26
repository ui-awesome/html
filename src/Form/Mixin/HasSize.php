<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the `size` attribute.
 *
 * @mixin HasAttributes
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/size
 */
trait HasSize
{
    use HasIntLikeAttribute;

    /**
     * Sets the `size` attribute.
     *
     * Usage example:
     * ```php
     * $element->size(10);
     * $element->size(50);
     * $element->size(null);
     * ```
     *
     * @param int|string|Stringable|UnitEnum|null $value Size value. Must be '>= 0', or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the value is not an integer-like value '>= 0'.
     *
     * @return static New instance with the updated `size` attribute.
     */
    public function size(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(
            Attribute::SIZE,
            self::intLikeAttribute($value, Attribute::SIZE),
        );
    }
}
