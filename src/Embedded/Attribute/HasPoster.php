<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `poster` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/video#poster
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasPoster
{
    /**
     * Sets the `poster` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Video::tag()
     *     ->poster('/images/cover.jpg')
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Poster image URL, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `poster` attribute.
     */
    public function poster(string|UnitEnum|null $value): static
    {
        return $this->setAttribute('poster', $value);
    }
}
