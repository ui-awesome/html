<?php

declare(strict_types=1);

namespace UIAwesome\Html\Attribute;

/**
 * Trait for managing the HTML `defer` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `defer` attribute on `<script>` elements.
 *
 * Key features.
 * - Handles the HTML `defer` attribute for script execution.
 * - Immutable method for setting or overriding the `defer` attribute.
 * - Supports bool for explicit deferred loading control.
 *
 * @method static addAttribute(string|\UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script#defer
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasDefer
{
    /**
     * Sets the HTML `defer` attribute for the element.
     *
     * Creates a new instance with the specified defer value. When `true`, the script is meant to be executed after the
     * document has been parsed, but before firing the DOMContentLoaded event.
     *
     * @param bool $value Whether the script should be deferred.
     *
     * @return static New instance with the updated `defer` attribute.
     */
    public function defer(bool $value): static
    {
        return $this->addAttribute('defer', $value);
    }
}
