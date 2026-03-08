<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;
use UIAwesome\Html\Table\Attribute\{HasColspan, HasHeaders, HasRowspan};

/**
 * Renders the HTML `<td>` element for table data cells.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Td::tag()
 *     ->colspan(2)
 *     ->content('Total')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/td
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Td extends BaseBlock
{
    use HasColspan;
    use HasHeaders;
    use HasRowspan;

    /**
     * Returns the tag enumeration for the `<td>` element.
     *
     * @return Table Tag enumeration instance for `<td>`.
     *
     * {@see Table} for valid table tags.
     */
    protected function getTag(): Table
    {
        return Table::TD;
    }
}
