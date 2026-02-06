<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

/**
 * Provides an immutable API for the HTML `nomodule` attribute.
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
     * Sets the `nomodule` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Script::tag()
     *     ->src('/assets/legacy.js')
     *     ->nomodule(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to prevent execution in browsers that support modules.
     *
     * @return static New instance with the updated `nomodule` attribute.
     */
    public function nomodule(bool $value): static
    {
        return $this->addAttribute('nomodule', $value);
    }
}
