<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<tbody>` element for table body row groups.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Table\{Tbody, Td, Tr};
 *
 * echo Tbody::tag()
 *     ->tr(
 *         Tr::tag()
 *             ->td(Td::tag()->content('Jane'))
 *             ->td(Td::tag()->content('Engineering'))
 *     )
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/tbody
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Tbody extends BaseBlock
{
    /**
     * Appends a `<tr>` element with `<td>` cells for each value.
     *
     * Usage example:
     * ```php
     * $tbody = \UIAwesome\Html\Table\Tbody::tag()->row('Jane', '30', 'NYC');
     * ```
     *
     * @param string|Stringable ...$cells Content for each `<td>` cell.
     *
     * @return static New instance with the appended data row.
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
     * $tbody = \UIAwesome\Html\Table\Tbody::tag()->rows(['Jane', '30'], ['John', '25']);
     * ```
     *
     * @param array<array-key, string|Stringable> ...$rows Arrays of cell content for each row.
     *
     * @return static New instance with the appended data rows.
     */
    public function rows(array ...$rows): static
    {
        $tbody = $this;

        foreach ($rows as $row) {
            $tbody = $tbody->row(...array_values($row));
        }

        return $tbody;
    }

    /**
     * Appends a `<tr>` element to the table body.
     *
     * Usage example:
     * ```php
     * $tr = \UIAwesome\Html\Table\Tr::tag()->td(Td::tag()->content('Jane'));
     * $tbody = \UIAwesome\Html\Table\Tbody::tag()->tr($tr);
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
     * Returns the tag enumeration for the `<tbody>` element.
     *
     * @return Table Tag enumeration instance for `<tbody>`.
     *
     * {@see Table} for valid table tags.
     */
    protected function getTag(): Table
    {
        return Table::TBODY;
    }
}
