<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `loop` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio#loop
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasLoop
{
    /**
     * Sets the `loop` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->loop(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether media should restart automatically when playback reaches the end.
     *
     * @return static New instance with the updated `loop` attribute.
     */
    public function loop(bool $value): static
    {
        return $this->setAttribute('loop', $value);
    }
}
