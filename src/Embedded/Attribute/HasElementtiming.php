<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UnitEnum;

/**
 * Trait for managing the HTML `elementtiming` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `elementtiming` attribute on HTML elements.
 *
 * Intended for use in tags and components that require manipulation of the `elementtiming` attribute.
 *
 * Key features.
 * - Designed for use in image elements (img) requiring performance observation.
 * - Handles the HTML `elementtiming` attribute.
 * - Immutable method for setting or overriding the `elementtiming` attribute.
 * - Supports string and `null` for flexible element timing identifier assignment.
 *
 * @method static addAttribute(string|UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/elementtiming
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasElementtiming
{
    /**
     * Sets the HTML `elementtiming` attribute for the element.
     *
     * Creates a new instance with the specified element timing identifier value, supporting explicit assignment
     * according to the HTML specification for performance observation.
     *
     * The `elementtiming` attribute marks the element for observation by the PerformanceElementTiming API. When set,
     * the browser will record timing information about the element's rendering, which can be accessed via the
     * PerformanceObserver API. This is useful for measuring performance of important page elements.
     *
     * @param string|UnitEnum|null $value Element timing identifier to set for the element. Use a descriptive string
     * identifier (for example, "hero-image"). Can be `null` to unset the attribute.
     *
     * @return static New instance with the updated `elementtiming` attribute.
     *
     * Usage example:
     * ```php
     * $element->elementtiming('hero-image');
     * $element->elementtiming('product-thumbnail');
     * $element->elementtiming(null);
     * ```
     */
    public function elementtiming(string|UnitEnum|null $value): static
    {
        return $this->addAttribute('elementtiming', $value);
    }
}
