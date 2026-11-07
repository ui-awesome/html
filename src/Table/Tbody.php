<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<tbody>` element for table body row groups.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/tbody
 * {@see BaseBlock} for the base implementation.
 */
final class Tbody extends BaseBlock
{
    /**
     * Appends a `<tr>` element with `<td>` cells for each value.
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
     * @param array<array-key, string|Stringable> ...$rows Arrays of cell content for each row.
     *
     * @return static New instance with the appended data rows.
     */
    public function rows(array ...$rows): static
    {
        $tbody = $this;

        foreach ($rows as $row) {
            $tbody = $tbody->row(...$row);
        }

        return $tbody;
    }

    /**
     * Appends a `<tr>` element to the table body.
     *
     * @param Tr $tr Table row element instance.
     *
     * @return static New instance with the appended table row.
     */
    public function tr(Tr $tr): static
    {
        return $this->html($this->getContent() === '' ? '' : "\n", $tr);
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
