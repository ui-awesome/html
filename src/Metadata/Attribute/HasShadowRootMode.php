<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Metadata\Values\ShadowRootMode;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `shadowrootmode` attribute.
 *
 * @method static addAttribute(string|UnitEnum $key, mixed $value) Adds an attribute and returns a new instance.
 * {@see \UIAwesome\Html\Mixin\HasAttributes} for managing the underlying attributes array.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootmode
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasShadowRootMode
{
    /**
     * Sets the `shadowrootmode` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Metadata\Template::tag()
     *     ->shadowRootMode(\UIAwesome\Html\Metadata\Values\ShadowRootMode::OPEN)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Shadow root mode (`open` or `closed`), or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `shadowrootmode` attribute.
     *
     * {@see ShadowRootMode} for predefined enum values.
     */
    public function shadowRootMode(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, ShadowRootMode::cases(), 'shadowrootmode');

        return $this->addAttribute('shadowrootmode', $value);
    }
}
