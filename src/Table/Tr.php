<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<tr>` element for table rows.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/tr
 * {@see BaseBlock} for the base implementation.
 */
final class Tr extends BaseBlock
{
    /**
     * Appends `<td>` elements for each value.
     *
     * @param string|Stringable ...$values Content for each `<td>` cell.
     *
     * @return static New instance with the appended data cells.
     */
    public function cells(string|Stringable ...$values): static
    {
        $tr = $this;

        foreach ($values as $value) {
            $tr = $tr->td(Td::tag()->content($value));
        }

        return $tr;
    }

    /**
     * Appends `<th>` elements for each value.
     *
     * @param string|Stringable ...$values Content for each `<th>` cell.
     *
     * @return static New instance with the appended header cells.
     */
    public function headerCells(string|Stringable ...$values): static
    {
        $tr = $this;

        foreach ($values as $value) {
            $tr = $tr->th(Th::tag()->content($value));
        }

        return $tr;
    }

    /**
     * Appends a `<td>` element to the row.
     *
     * @param Td $td Table data cell element instance.
     *
     * @return static New instance with the appended table data cell.
     */
    public function td(Td $td): static
    {
        return $this->html($this->getContent() === '' ? '' : "\n", $td);
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
        return $this->html($this->getContent() === '' ? '' : "\n", $th);
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
