<?php

declare(strict_types=1);

namespace UIAwesome\Html\Attribute;

/**
 * Trait for managing the HTML `nomodule` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `nomodule` attribute on `<script>` elements.
 *
 * Key features.
 * - Handles the HTML `nomodule` attribute for script execution.
 * - Immutable method for setting or overriding the `nomodule` attribute.
 * - Supports bool for explicit module fallback control.
 *
 * @method static addAttribute(string|\UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script#nomodule
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasNomodule
{
    /**
     * Sets the HTML `nomodule` attribute for the element.
     *
     * Creates a new instance with the specified nomodule value. When `true`, the script should not be executed in
     * browsers that support ES modules — in effect, this can be used to serve fallback scripts to older browsers.
     *
     * @param bool $value Whether the script should not be executed as a module.
     *
     * @return static New instance with the updated `nomodule` attribute.
     */
    public function nomodule(bool $value): static
    {
        return $this->addAttribute('nomodule', $value);
    }
}
