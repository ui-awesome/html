<?php

declare(strict_types=1);

namespace UIAwesome\Html\List\Attribute;

/**
 * Provides an immutable API for the HTML `start` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/ol#start
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasStart
{
    /**
     * Sets the `start` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\List\Ol::tag()->start(4)->render();
     * echo \UIAwesome\Html\List\Ol::tag()->start(null)->render();
     * ```
     *
     * @param int|null $value Ordinal start value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `start` attribute.
     */
    public function start(int|null $value): static
    {
        return $this->setAttribute('start', $value);
    }
}
