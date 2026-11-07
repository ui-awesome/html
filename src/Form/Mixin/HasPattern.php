<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use Stringable;
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the `pattern` attribute.
 *
 * @mixin HasAttributes
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/pattern
 */
trait HasPattern
{
    /**
     * Sets the `pattern` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Pattern value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `pattern` attribute.
     */
    public function pattern(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::PATTERN, $value);
    }
}
