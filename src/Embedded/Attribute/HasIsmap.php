<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

/**
 * Provides an immutable API for the HTML `ismap` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/img#ismap
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasIsmap
{
    /**
     * Sets the `ismap` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Img::tag()
     *     ->ismap(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether the image is a server-side image map.
     *
     * @return static New instance with the updated `ismap` attribute.
     */
    public function ismap(bool $value): static
    {
        return $this->setAttribute('ismap', $value);
    }
}
