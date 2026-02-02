<?php

declare(strict_types=1);

namespace UIAwesome\Html\List\Attribute;

/**
 * Trait for managing the HTML `start` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `start` attribute on `<ol>` elements.
 *
 * Intended for use in tags and components that require manipulation of the `start` attribute.
 *
 * Key features.
 * - Designed for use in ordered list ol elements.
 * - Handles the HTML `start` attribute for setting the starting number of list items.
 * - Immutable method for setting or overriding the `start` attribute.
 * - Supports int for explicit starting number assignment.
 *
 * @method static addAttribute(string|\UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/ol#start
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasStart
{
    /**
     * Sets the HTML `start` attribute for the element.
     *
     * Creates a new instance with the specified start value. The value is always an Arabic numeral (1, 2, 3, etc.),
     * even when the numbering type is letters or Roman numerals.
     *
     * @param int|null $value Integer to start counting from. Can be `null` to unset the attribute.
     *
     * @return static New instance with the updated `start` attribute.
     *
     * Usage example:
     * ```php
     * $element->start(4);
     * $element->start(null);
     * ```
     */
    public function start(int|null $value): static
    {
        return $this->addAttribute('start', $value);
    }
}
