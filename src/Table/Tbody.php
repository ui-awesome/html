<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<tbody>` element for table body row groups.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Tbody::tag()
 *     ->tr(
 *         \UIAwesome\Html\Table\Tr::tag()
 *             ->td(\UIAwesome\Html\Table\Td::tag()->content('Jane'))
 *             ->td(\UIAwesome\Html\Table\Td::tag()->content('Engineering'))
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
     * Appends a `<tr>` element to the table body.
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
