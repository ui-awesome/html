<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;
use InvalidArgumentException;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Table\Values\Scope;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `scope` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/th#scope
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasScope
{
    /**
     * Sets the `scope` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Th::tag()
     *     ->content('Total')
     *     ->scope(\UIAwesome\Html\Table\Values\Scope::ROW)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Scope of related cells (`row`, `col`, `rowgroup`, `colgroup`), or `null` to
     * remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `scope` attribute.
     *
     * {@see Scope} for predefined enum values.
     */
    public function scope(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Scope::cases(), 'scope');

        return $this->setAttribute('scope', $value);
    }
}
