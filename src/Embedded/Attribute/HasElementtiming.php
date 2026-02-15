<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UnitEnum;

/**
 * Provides an immutable API for the HTML `elementtiming` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/elementtiming
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasElementtiming
{
    /**
     * Sets the `elementtiming` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Img::tag()->elementtiming('hero-image')->render();
     * echo \UIAwesome\Html\Embedded\Img::tag()->elementtiming('product-thumbnail')->render();
     * echo \UIAwesome\Html\Embedded\Img::tag()->elementtiming(null)->render();
     * ```
     *
     * @param string|UnitEnum|null $value Element timing identifier, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `elementtiming` attribute.
     */
    public function elementtiming(string|UnitEnum|null $value): static
    {
        return $this->setAttribute('elementtiming', $value);
    }
}
