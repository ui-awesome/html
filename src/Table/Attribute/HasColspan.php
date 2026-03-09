<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table\Attribute;

use UIAwesome\Html\Mixin\HasAttributes;
use InvalidArgumentException;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Helper\Validator;

/**
 * Provides an immutable API for the HTML `colspan` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/td#colspan
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasColspan
{
    /**
     * Sets the `colspan` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Td::tag()
     *     ->colspan(2)
     *     ->render();
     * ```
     *
     * @param int|string|null $value Number of columns a cell spans (`1` to `1000`), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not an integer-like value between `1` and `1000`.
     *
     * @return static New instance with the updated `colspan` attribute.
     */
    public function colspan(int|string|null $value): static
    {
        if ($value !== null && Validator::intLike($value, 1, 1000) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    'colspan',
                    '1 <= value <= 1000',
                ),
            );
        }

        return $this->setAttribute('colspan', $value);
    }
}
