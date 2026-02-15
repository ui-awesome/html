<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

/**
 * Provides an immutable API for the HTML `async` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script#async
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasAsync
{
    /**
     * Sets the `async` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Script::tag()
     *     ->src('/assets/app.js')
     *     ->async(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to execute the script asynchronously.
     *
     * @return static New instance with the updated `async` attribute.
     */
    public function async(bool $value): static
    {
        return $this->setAttribute('async', $value);
    }
}
