<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `shadowrootreferencetarget` attribute.
 *
 * @method static addAttribute(string|UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootreferencetarget
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasShadowRootReferenceTarget
{
    /**
     * Sets the `shadowrootreferencetarget` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootReferenceTarget('dialog-title')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Reference target ID, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `shadowrootreferencetarget` attribute.
     */
    public function shadowRootReferenceTarget(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('shadowrootreferencetarget', $value);
    }
}
