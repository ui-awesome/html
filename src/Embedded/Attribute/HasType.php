<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `type` attribute on `<source>` elements.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/source#type
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasType
{
    /**
     * Sets the `type` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Embedded\Source::tag()
     *     ->type('video/webm')
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Resource MIME type, optionally including a codecs parameter, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `type` attribute.
     */
    public function type(string|UnitEnum|null $value): static
    {
        return $this->setAttribute('type', $value);
    }
}
