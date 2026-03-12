<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `shadowrootdelegatesfocus` attribute.
 *
 * Experimental HTML attribute. Availability and behavior may vary across browsers.
 *
 * @mixin HasAttributes
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
        return $this->setAttribute('shadowrootdelegatesfocus', $value);
    }
}
