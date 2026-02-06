<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

/**
 * Provides an immutable API for the HTML `shadowrootdelegatesfocus` attribute.
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
     * Sets the `shadowrootdelegatesfocus` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootDelegatesFocus(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to delegate focus into the generated shadow root.
     *
     * @return static New instance with the updated `shadowrootdelegatesfocus` attribute.
     */
    public function shadowRootDelegatesFocus(bool $value): static
    {
        return $this->addAttribute('shadowrootdelegatesfocus', $value);
    }
}
