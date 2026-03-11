<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `disablepictureinpicture` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/video#disablepictureinpicture
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasDisablepictureinpicture
{
    /**
     * Sets the `disablepictureinpicture` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
     *     ->disablepictureinpicture(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether Picture-in-Picture controls and suggestions should be disabled.
     *
     * @return static New instance with the updated `disablepictureinpicture` attribute.
     */
    public function disablepictureinpicture(bool $value): static
    {
        return $this->setAttribute('disablepictureinpicture', $value);
    }
}
