<?php

declare(strict_types=1);

namespace UIAwesome\Html\Attribute;

use Stringable;
use UnitEnum;

/**
 * Trait for managing the HTML `shadowrootreferencetarget` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `shadowrootreferencetarget` attribute on `<template>` elements.
 *
 * Key features.
 * - Handles the HTML `shadowrootreferencetarget` attribute.
 * - Immutable method for setting or overriding the `shadowrootreferencetarget` attribute.
 * - Supports string, Stringable, UnitEnum, and `null` for flexible reference target assignment.
 *
 * @method static addAttribute(string|UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootreferencetarget
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasShadowRootReferenceTarget
{
    /**
     * Sets the HTML `shadowrootreferencetarget` attribute for the element.
     *
     * Creates a new instance with the specified reference target value. Specifies the ID of an element within the
     * shadow root that should be used as the reference target for the shadow host element. Can be `null` to unset the
     * attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Reference target ID to set for the element. Should be the ID of an
     * element within the shadow root.
     *
     * @return static New instance with the updated `shadowrootreferencetarget` attribute.
     */
    public function shadowRootReferenceTarget(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('shadowrootreferencetarget', $value);
    }
}
