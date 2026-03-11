<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `autoplay` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio#autoplay
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasAutoplay
{
    /**
     * Sets the `autoplay` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->autoplay(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether media should automatically begin playback when it can.
     *
     * @return static New instance with the updated `autoplay` attribute.
     */
    public function autoplay(bool $value): static
    {
        return $this->setAttribute('autoplay', $value);
    }
}
