<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `shadowrootclonable` attribute.
 *
 * Experimental HTML attribute. Availability and behavior may vary across browsers.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootclonable
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasShadowRootClonable
{
    /**
     * Sets the `shadowrootclonable` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootClonable(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to allow cloning the generated shadow root.
     *
     * @return static New instance with the updated `shadowrootclonable` attribute.
     */
    public function shadowRootClonable(bool $value): static
    {
        return $this->setAttribute('shadowrootclonable', $value);
    }
}
