<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

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
