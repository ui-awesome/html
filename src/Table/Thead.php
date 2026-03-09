<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<thead>` element for table header row groups.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Thead::tag()
 *     ->tr(
 *         \UIAwesome\Html\Table\Tr::tag()->th(
 *             \UIAwesome\Html\Table\Th::tag()->content('Name')
 *         )
 *     )
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/thead
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Thead extends BaseBlock
{
    /**
     * Appends a `<tr>` element with `<th>` cells for each value.
     *
     * Usage example:
     * ```php
     * $thead = \UIAwesome\Html\Table\Thead::tag()->row('Name', 'Age', 'City');
     * ```
     *
     * @param string|Stringable ...$cells Content for each `<th>` cell.
     *
     * @return static New instance with the appended header row.
     */
    public function row(string|Stringable ...$cells): static
    {
        return $this->tr(Tr::tag()->headerCells(...$cells));
    }

    /**
     * Appends multiple `<tr>` elements with `<th>` cells.
     *
     * Usage example:
     * ```php
     * $thead = \UIAwesome\Html\Table\Thead::tag()->rows(['Name', 'Age'], ['ID', 'Email']);
     * ```
     *
     * @param array<int, string|Stringable> ...$rows Arrays of cell content for each row.
     *
     * @return static New instance with the appended header rows.
     */
    public function rows(array ...$rows): static
    {
        $thead = $this;

        foreach ($rows as $row) {
            $thead = $thead->row(...array_values($row));
        }

        return $thead;
    }

    /**
     * Appends a `<tr>` element to the table header.
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
     * Returns the tag enumeration for the `<thead>` element.
     *
     * @return Table Tag enumeration instance for `<thead>`.
     *
     * {@see Table} for valid table tags.
     */
    protected function getTag(): Table
    {
        return Table::THEAD;
    }
}
