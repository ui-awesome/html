<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<tfoot>` element for table footer row groups.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Table\{Td, Tfoot, Tr};
 *
 * echo Tfoot::tag()
 *     ->tr(Tr::tag()->td(Td::tag()->content('Totals')))
 *     ->tr(Tr::tag()->td(Td::tag()->content('100')))
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/tfoot
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Tfoot extends BaseBlock
{
    /**
     * Appends a `<tr>` element with `<td>` cells for each value.
     *
     * Usage example:
     * ```php
     * $tfoot = \UIAwesome\Html\Table\Tfoot::tag()->row('Totals', '100');
     * ```
     *
     * @param string|Stringable ...$cells Content for each `<td>` cell.
     *
     * @return static New instance with the appended footer row.
     */
    public function row(string|Stringable ...$cells): static
    {
        return $this->tr(Tr::tag()->cells(...$cells));
    }

    /**
     * Appends multiple `<tr>` elements with `<td>` cells.
     *
     * Usage example:
     * ```php
     * $tfoot = \UIAwesome\Html\Table\Tfoot::tag()->rows(['Subtotal', '80'], ['Total', '100']);
     * ```
     *
     * @param array<array-key, string|Stringable> ...$rows Arrays of cell content for each row.
     *
     * @return static New instance with the appended footer rows.
     */
    public function rows(array ...$rows): static
    {
        $tfoot = $this;

        foreach ($rows as $row) {
            $tfoot = $tfoot->row(...array_values($row));
        }

        return $tfoot;
    }

    /**
     * Appends a `<tr>` element to the table footer.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Table\Tfoot::tag()
     *     ->tr(Tr::tag()->td(Td::tag()->content('Totals')))
     *     ->render();
     * ```
     *
     * @param Tr $tr Table row element instance.
     *
     * @return static New instance with the appended table row.
     */
    public function tr(Tr $tr): static
    {
        return $this->html($tr, "\n");
    }

    /**
     * Returns the tag enumeration for the `<tfoot>` element.
     *
     * @return Table Tag enumeration instance for `<tfoot>`.
     *
     * {@see Table} for valid table tags.
     */
    protected function getTag(): Table
    {
        return Table::TFOOT;
    }
}
