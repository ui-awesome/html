<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `disableremoteplayback` attribute.
 *
 * Experimental HTML attribute. Availability and behavior may vary across browsers.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio#disableremoteplayback
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasDisableremoteplayback
{
    /**
     * Sets the `disableremoteplayback` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->disableremoteplayback(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether remote playback should be disabled.
     *
     * @return static New instance with the updated `disableremoteplayback` attribute.
     */
    public function disableremoteplayback(bool $value): static
    {
        return $this->setAttribute('disableremoteplayback', $value);
    }
}
