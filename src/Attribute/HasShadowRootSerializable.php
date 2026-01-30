<?php

declare(strict_types=1);

namespace UIAwesome\Html\Attribute;

/**
 * Trait for managing the HTML `shadowrootserializable` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `shadowrootserializable` attribute on `<template>` elements.
 *
 * Key features.
 * - Handles the HTML `shadowrootserializable` attribute.
 * - Immutable method for setting or overriding the `shadowrootserializable` attribute.
 * - Supports bool for explicit serialization control.
 *
 * @method static addAttribute(string|\UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootserializable
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasShadowRootSerializable
{
    /**
     * Sets the HTML `shadowrootserializable` attribute for the element.
     *
     * Creates a new instance with the specified serializable value. When `true`, the shadow root is serializable when
     * the `<template>` element is serialized.
     *
     * @param bool $value Whether the shadow root should be serializable when the template is serialized.
     *
     * @return static New instance with the updated `shadowrootserializable` attribute.
     */
    public function shadowRootSerializable(bool $value): static
    {
        return $this->addAttribute('shadowrootserializable', $value);
    }
}
