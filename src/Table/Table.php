<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table as TableTag;

use function is_string;

/**
 * Renders the HTML `<table>` element for tabular data.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/table
 * {@see BaseBlock} for the base implementation.
 */
final class Table extends BaseBlock
{
    /**
     * Appends a `<caption>` element to the table.
     *
     * Accepts a `Caption` instance for full control, or a string that is automatically wrapped in a `Caption` element.
     *
     * @param Caption|string|null $caption Caption instance, string content, or `null` to skip.
     *
     * @return static New instance with the appended table caption.
     */
    public function caption(Caption|string|null $caption): static
    {
        if ($caption === null) {
            return $this;
        }

        if (is_string($caption)) {
            $caption = Caption::tag()->content($caption);
        }

        return $this->html($this->getContent() === '' ? '' : "\n", $caption);
    }

    /**
     * Appends a `<colgroup>` element to the table.
     *
     * @param Colgroup $colgroup Table column group element instance.
     *
     * @return static New instance with the appended table column group.
     */
    public function colgroup(Colgroup $colgroup): static
    {
        return $this->html($this->getContent() === '' ? '' : "\n", $colgroup);
    }

    /**
     * Appends a `<tbody>` element to the table.
     *
     * @param Tbody $tbody Table body element instance.
     *
     * @return static New instance with the appended table body.
     */
    public function tbody(Tbody $tbody): static
    {
        return $this->html($this->getContent() === '' ? '' : "\n", $tbody);
    }

    /**
     * Appends a `<tfoot>` element to the table.
     *
     * @param Tfoot $tfoot Table footer element instance.
     *
     * @return static New instance with the appended table footer.
     */
    public function tfoot(Tfoot $tfoot): static
    {
        return $this->html($this->getContent() === '' ? '' : "\n", $tfoot);
    }

    /**
     * Appends a `<thead>` element to the table.
     *
     * @param Thead $thead Table head element instance.
     *
     * @return static New instance with the appended table head.
     */
    public function thead(Thead $thead): static
    {
        return $this->html($this->getContent() === '' ? '' : "\n", $thead);
    }

    /**
     * Appends a `<tr>` element directly to the table.
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
     * Returns the tag enumeration for the `<table>` element.
     *
     * @return TableTag Tag enumeration instance for `<table>`.
     *
     * {@see TableTag} for valid table tags.
     */
    protected function getTag(): TableTag
    {
        return TableTag::TABLE;
    }
}
