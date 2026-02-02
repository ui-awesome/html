<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

/**
 * Trait for managing the HTML `ismap` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `ismap` attribute on `<img>` elements.
 *
 * Key features.
 * - Handles the HTML `ismap` attribute for server-side image maps.
 * - Immutable method for setting or overriding the `ismap` attribute.
 * - Supports bool for explicit server-side image map control.
 *
 * @method static addAttribute(string|\UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/img#ismap
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasIsmap
{
    /**
     * Sets the HTML `ismap` attribute for the element.
     *
     * Creates a new instance with the specified ismap value.
     *
     * When `true`, the image is part of a server-side image map. This attribute is only permitted if the `<img>`
     * element is a descendant of an `<a>` element with a valid `href` attribute.
     *
     * @param bool $value Whether the image is a server-side image map.
     *
     * @return static New instance with the updated `ismap` attribute.
     */
    public function ismap(bool $value): static
    {
        return $this->addAttribute('ismap', $value);
    }
}
