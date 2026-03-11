<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `playsinline` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/video#playsinline
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasPlaysinline
{
    /**
     * Sets the `playsinline` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
     *     ->playsinline(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether video playback should stay inline instead of entering fullscreen.
     *
     * @return static New instance with the updated `playsinline` attribute.
     */
    public function playsinline(bool $value): static
    {
        return $this->setAttribute('playsinline', $value);
    }
}
