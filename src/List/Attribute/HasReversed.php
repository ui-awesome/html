<?php

declare(strict_types=1);

namespace UIAwesome\Html\List\Attribute;

/**
 * Trait for managing the HTML `reversed` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `reversed` attribute on `<ol>` elements.
 *
 * Intended for use in tags and components that require manipulation of the `reversed` attribute.
 *
 * Key features.
 * - Designed for use in ordered list ol elements.
 * - Handles the HTML `reversed` attribute for reverse ordering of list items.
 * - Immutable method for setting or overriding the `reversed` attribute.
 * - Supports bool for explicit reverse ordering control.
 *
 * @method static addAttribute(string|\UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/ol#reversed
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasReversed
{
    /**
     * Sets the HTML `reversed` attribute for the element.
     *
     * Creates a new instance with the specified reversed value. When `true`, the list's items are numbered in reverse
     * order (from high to low).
     *
     * @param bool $value Whether the list items should be in reverse order.
     *
     * @return static New instance with the updated `reversed` attribute.
     *
     * Usage example:
     * ```php
     * $element->reversed(true);
     * ```
     */
    public function reversed(bool $value): static
    {
        return $this->addAttribute('reversed', $value);
    }
}
