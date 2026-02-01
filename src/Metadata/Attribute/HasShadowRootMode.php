<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Metadata\Values\ShadowRootMode;
use UnitEnum;

/**
 * Trait for managing the HTML `shadowrootmode` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `shadowrootmode` attribute on `<template>` elements.
 *
 * Key features.
 * - Handles the HTML `shadowrootmode` attribute.
 * - Immutable method for setting or overriding the `shadowrootmode` attribute.
 * - Supports string, UnitEnum, and `null` for flexible mode assignment.
 *
 * @method static addAttribute(string|UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootmode
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasShadowRootMode
{
    /**
     * Sets the HTML `shadowrootmode` attribute for the element.
     *
     * Creates a new instance with the specified shadow root mode value. Defines the mode of the shadow root created
     * from this `<template>` element. When set to `open`, the shadow root is accessible via JavaScript; when set to
     * `closed`, the internal shadow root DOM is hidden from JavaScript. Can be `null` to unset the attribute.
     *
     * @param string|UnitEnum|null $value Shadow root mode value to set for the element. Use `open` or `closed`.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `shadowrootmode` attribute.
     *
     * {@see ShadowRootMode} for predefined enum values.
     */
    public function shadowRootMode(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, ShadowRootMode::cases(), 'shadowrootmode');

        return $this->addAttribute('shadowrootmode', $value);
    }
}
