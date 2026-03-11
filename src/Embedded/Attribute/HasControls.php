<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `controls` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio#controls
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasControls
{
    /**
     * Sets the `controls` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->controls(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether browser playback controls should be displayed.
     *
     * @return static New instance with the updated `controls` attribute.
     */
    public function controls(bool $value): static
    {
        return $this->setAttribute('controls', $value);
    }
}
