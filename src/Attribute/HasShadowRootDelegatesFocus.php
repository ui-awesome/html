<?php

declare(strict_types=1);

namespace UIAwesome\Html\Attribute;

/**
 * Trait for managing the HTML `shadowrootdelegatesfocus` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `shadowrootdelegatesfocus` attribute on `<template>` elements.
 *
 * Key features.
 * - Handles the HTML `shadowrootdelegatesfocus` attribute.
 * - Immutable method for setting or overriding the `shadowrootdelegatesfocus` attribute.
 * - Supports bool for explicit focus delegation control.
 *
 * @method static addAttribute(string|\UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootdelegatesfocus
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasShadowRootDelegatesFocus
{
    /**
     * Sets the HTML `shadowrootdelegatesfocus` attribute for the element.
     *
     * Creates a new instance with the specified delegates focus value.
     *
     * @param bool $value Whether the shadow root delegates focus.
     *
     * @return static New instance with the updated `shadowrootdelegatesfocus` attribute.
     */
    public function shadowRootDelegatesFocus(bool $value): static
    {
        return $this->addAttribute('shadowrootdelegatesfocus', $value);
    }
}
