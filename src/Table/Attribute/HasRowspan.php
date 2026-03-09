<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;
use InvalidArgumentException;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Helper\Validator;

/**
 * Provides an immutable API for the HTML `rowspan` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/td#rowspan
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasRowspan
{
    /**
     * Sets the `rowspan` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Td::tag()
     *     ->rowspan(2)
     *     ->render();
     * ```
     *
     * @param int|string|null $value Number of rows a cell spans (`0` to `65534`), or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not an integer-like value between `0` and `65534`.
     *
     * @return static New instance with the updated `rowspan` attribute.
     */
    public function rowspan(int|string|null $value): static
    {
        if ($value !== null && Validator::intLike($value, 0, 65534) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    'rowspan',
                    '0 <= value <= 65534',
                ),
            );
        }

        return $this->setAttribute('rowspan', $value);
    }
}
