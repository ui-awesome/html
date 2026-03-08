<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<tfoot>` element for table footer row groups.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Tfoot::tag()
 *     ->tr(\UIAwesome\Html\Table\Tr::tag()->content('Totals'))
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
     * Appends a `<tr>` element to the table footer.
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
