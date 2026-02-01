<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

/**
 * Trait for managing the HTML `async` attribute in tag rendering.
 *
 * Provides an immutable API for setting the `async` attribute on `<script>` elements.
 *
 * Key features.
 * - Handles the HTML `async` attribute for script execution.
 * - Immutable method for setting or overriding the `async` attribute.
 * - Supports bool for explicit async loading control.
 *
 * @method static addAttribute(string|\UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/script#async
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasAsync
{
    /**
     * Sets the HTML `async` attribute for the element.
     *
     * Creates a new instance with the specified async value. When `true`, the script will be fetched in parallel to
     * parsing and evaluated as soon as it is available.
     *
     * @param bool $value Whether the script should be loaded asynchronously.
     *
     * @return static New instance with the updated `async` attribute.
     */
    public function async(bool $value): static
    {
        return $this->addAttribute('async', $value);
    }
}
