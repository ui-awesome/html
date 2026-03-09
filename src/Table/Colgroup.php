<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;
use UIAwesome\Html\Table\Attribute\HasSpan;

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
    use HasSpan;

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
