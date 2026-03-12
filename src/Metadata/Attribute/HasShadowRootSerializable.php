<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `shadowrootserializable` attribute.
 *
 * Experimental HTML attribute. Availability and behavior may vary across browsers.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootserializable
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasShadowRootSerializable
{
    /**
     * Sets the `shadowrootserializable` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootSerializable(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to allow serializing the generated shadow root.
     *
     * @return static New instance with the updated `shadowrootserializable` attribute.
     */
    public function shadowRootSerializable(bool $value): static
    {
        return $this->setAttribute('shadowrootserializable', $value);
    }
}
