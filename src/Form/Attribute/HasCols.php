<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use InvalidArgumentException;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Helper\Validator;

/**
 * Provides an immutable API for the HTML `cols` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/textarea#cols
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasCols
{
    /**
     * Sets the `cols` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\TextArea::tag()
     *     ->cols(20)
     *     ->render();
     * ```
     *
     * @param int|string|null $value Visible width in average character widths (positive integer), or `null` to remove
     * the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not a positive integer.
     *
     * @return static New instance with the updated `cols` attribute.
     */
    public function cols(int|string|null $value): static
    {
        if ($value !== null && Validator::intLike($value, 1) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    'cols',
                    'value > 0',
                ),
            );
        }

        return $this->setAttribute('cols', $value);
    }
}
