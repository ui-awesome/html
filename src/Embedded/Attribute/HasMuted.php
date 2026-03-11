<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;

/**
 * Provides an immutable API for the HTML `muted` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio#muted
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasMuted
{
    /**
     * Sets the `muted` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Audio::tag()
     *     ->muted(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether media output should be initially muted.
     *
     * @return static New instance with the updated `muted` attribute.
     */
    public function muted(bool $value): static
    {
        return $this->setAttribute('muted', $value);
    }
}
