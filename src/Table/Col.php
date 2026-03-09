<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\Voids;
use UIAwesome\Html\Table\Attribute\HasSpan;

/**
 * Renders the HTML `<col>` element for table column definitions.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Col::tag()
 *     ->span(2)
 *     ->class('weekdays')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/col
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Col extends BaseVoid
{
    use HasSpan;

    /**
     * Returns the tag enumeration for the `<col>` element.
     *
     * @return Voids Tag enumeration instance for `<col>`.
     *
     * {@see Voids} for valid void-level tags.
     */
    protected function getTag(): Voids
    {
        return Voids::COL;
    }
}
