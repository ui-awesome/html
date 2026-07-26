<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use Stringable;
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Contracts\Form\PlaceholderInterface;
use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the `placeholder` attribute.
 *
 * Satisfies {@see PlaceholderInterface} for the controls that declare it.
 *
 * @mixin HasAttributes
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/placeholder
 */
trait HasPlaceholder
{
    /**
     * Sets the `placeholder` attribute.
     *
     * Usage example:
     * ```php
     * $element->placeholder('Enter your email');
     * $element->placeholder('for example, John Doe');
     * $element->placeholder(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Placeholder text, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `placeholder` attribute.
     */
    public function placeholder(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::PLACEHOLDER, $value);
    }
}
