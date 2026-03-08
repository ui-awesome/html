<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table\Attribute;

use UnitEnum;

/**
 * Provides an immutable API for the HTML `headers` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/td#headers
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasHeaders
{
    /**
     * Sets the `headers` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Td::tag()
     *     ->headers('name age')
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Space-separated list of header cell IDs, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `headers` attribute.
     */
    public function headers(string|UnitEnum|null $value): static
    {
        return $this->setAttribute('headers', $value);
    }
}
