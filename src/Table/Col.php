<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use InvalidArgumentException;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Voids;

/**
 * Renders the HTML `<col>` element for table column definitions.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Col::tag()
 *     ->span(2)
 *     ->class('weekdays')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/col
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Col extends BaseVoid
{
    /**
     * Sets the `span` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Col::tag()
     *     ->span(2)
     *     ->render();
     * ```
     *
     * @param int|string|null $value Number of consecutive columns this `<col>` spans ('1' to '1000'), or `null`
     * to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not an integer-like value between '1' and '1000'.
     *
     * @return static New instance with the updated `span` attribute.
     */
    public function span(int|string|null $value): static
    {
        if ($value !== null && Validator::intLike($value, 1, 1000) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    'span',
                    '1 <= value <= 1000',
                ),
            );
        }

        return $this->addAttribute('span', $value);
    }

    /**
     * Returns the tag enumeration for the `<col>` element.
     *
     * @return Voids Tag enumeration instance for `<col>`.
     *
     * {@see Voids} for valid void-level tags.
     */
    protected function getTag(): Voids
    {
        return Voids::COL;
    }
}
