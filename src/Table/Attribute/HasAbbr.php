<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `abbr` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/th#abbr
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasAbbr
{
    /**
     * Sets the `abbr` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Th::tag()
     *     ->abbr('International Business Machines')
     *     ->content('IBM')
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Abbreviated header description, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `abbr` attribute.
     */
    public function abbr(string|UnitEnum|null $value): static
    {
        return $this->setAttribute('abbr', $value);
    }
}
