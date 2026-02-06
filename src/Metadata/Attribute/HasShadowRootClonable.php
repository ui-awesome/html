<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

/**
 * Provides an immutable API for the HTML `shadowrootclonable` attribute.
 *
 * @method static addAttribute(string|\UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
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
        return $this->addAttribute('shadowrootclonable', $value);
    }
}
