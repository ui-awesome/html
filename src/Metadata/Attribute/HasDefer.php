<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

/**
 * Provides an immutable API for the HTML `defer` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script#defer
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasDefer
{
    /**
     * Sets the `defer` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Script::tag()
     *     ->src('/assets/app.js')
     *     ->defer(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to defer script execution.
     *
     * @return static New instance with the updated `defer` attribute.
     */
    public function defer(bool $value): static
    {
        return $this->setAttribute('defer', $value);
    }
}
