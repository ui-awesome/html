<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table\Values;

/**
 * Represents values for the HTML `scope` attribute on `<th>` elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/th#scope
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Scope: string
{
    /**
     * Header relates to all cells in its column (`col`).
     */
    case COL = 'col';

    /**
     * Header relates to all cells in its column group (`colgroup`).
     */
    case COLGROUP = 'colgroup';

    /**
     * Header relates to all cells in its row (`row`).
     */
    case ROW = 'row';

    /**
     * Header relates to all cells in its row group (`rowgroup`).
     */
    case ROWGROUP = 'rowgroup';
}
