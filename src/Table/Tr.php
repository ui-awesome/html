<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<tr>` element for table rows.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Tr::tag()
 *     ->th(\UIAwesome\Html\Table\Th::tag()->content('Name'))
 *     ->td(\UIAwesome\Html\Table\Td::tag()->content('Jane'))
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/tr
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Tr extends BaseBlock
{
    /**
     * Appends a `<td>` element to the row.
     *
     * @param Td $td Table data cell element instance.
     *
     * @return static New instance with the appended table data cell.
     */
    public function td(Td $td): static
    {
        return $this->html($td, "\n");
    }

    /**
     * Appends a `<th>` element to the row.
     *
     * @param Th $th Table header cell element instance.
     *
     * @return static New instance with the appended table header cell.
     */
    public function th(Th $th): static
    {
        return $this->html($th, "\n");
    }

    /**
     * Returns the tag enumeration for the `<tr>` element.
     *
     * @return Table Tag enumeration instance for `<tr>`.
     *
     * {@see Table} for valid table tags.
     */
    protected function getTag(): Table
    {
        return Table::TR;
    }
}
