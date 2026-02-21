<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Helper\Validator;

/**
 * Provides an immutable API for the HTML `rows` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/textarea#rows
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasRows
{
    /**
     * Sets the `rows` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\TextArea::tag()
     *     ->rows(5)
     *     ->render();
     * ```
     *
     * @param int|string|null $value Number of visible text lines (positive integer), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not a positive integer.
     *
     * @return static New instance with the updated `rows` attribute.
     */
    public function rows(int|string|null $value): static
    {
        if ($value !== null && Validator::intLike($value, 1) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    'rows',
                    'value > 0',
                ),
            );
        }

        return $this->setAttribute('rows', $value);
    }
}
