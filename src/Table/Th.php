<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;
use UIAwesome\Html\Table\Attribute\{HasAbbr, HasColspan, HasHeaders, HasRowspan, HasScope};

/**
 * Renders the HTML `<th>` element for table header cells.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Th::tag()
 *     ->content('Name')
 *     ->scope(\UIAwesome\Html\Table\Values\Scope::COL)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/th
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Th extends BaseBlock
{
    use HasAbbr;
    use HasColspan;
    use HasHeaders;
    use HasRowspan;
    use HasScope;

    /**
     * Returns the tag enumeration for the `<th>` element.
     *
     * @return Table Tag enumeration instance for `<th>`.
     *
     * {@see Table} for valid table tags.
     */
    protected function getTag(): Table
    {
        return Table::TH;
    }
}
