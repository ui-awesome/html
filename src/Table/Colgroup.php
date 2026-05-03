<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use InvalidArgumentException;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<colgroup>` element for table column groups.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Table\{Col, Colgroup};
 *
 * echo Colgroup::tag()
 *     ->col(Col::tag()->class('weekdays')->span(2))
 *     ->col(Col::tag()->class('weekend')->span(2))
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/colgroup
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Colgroup extends BaseBlock
{
    /**
     * Appends a `<col>` element to the column group.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Colgroup::tag()
     *     ->col(\UIAwesome\Html\Table\Col::tag()->class('weekdays')->span(2))
     *     ->render();
     * ```
     *
     * @param Col $col Table column element instance.
     *
     * @return static New instance with the appended table column.
     */
    public function col(Col $col): static
    {
        return $this->html($col, "\n");
    }

    /**
     * Appends multiple `<col>` elements to the column group.
     *
     * Usage example:
     * ```php
     * $colgroup = \UIAwesome\Html\Table\Colgroup::tag()->cols(
     *     \UIAwesome\Html\Table\Col::tag()->class('weekdays')->span(2),
     *     \UIAwesome\Html\Table\Col::tag()->class('weekend')->span(2),
     * );
     * ```
     *
     * @param Col ...$cols Table column element instances.
     *
     * @return static New instance with the appended table columns.
     */
    public function cols(Col ...$cols): static
    {
        $colgroup = $this;

        foreach ($cols as $col) {
            $colgroup = $colgroup->col($col);
        }

        return $colgroup;
    }

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
     * Returns the tag enumeration for the `<colgroup>` element.
     *
     * @return Table Tag enumeration instance for `<colgroup>`.
     *
     * {@see Table} for valid table tags.
     */
    protected function getTag(): Table
    {
        return Table::COLGROUP;
    }
}
