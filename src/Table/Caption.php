<?php

declare(strict_types=1);

namespace UIAwesome\Html\Table;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Table;

/**
 * Renders the HTML `<caption>` element for table captions.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Table\Caption::tag()
 *     ->content('Monthly sales report')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/caption
 * {@see BaseBlock} for the base implementation.
 */
final class Caption extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<caption>` element.
     *
     * @return Table Tag enumeration instance for `<caption>`.
     *
     * {@see Table} for valid table tags.
     */
    protected function getTag(): Table
    {
        return Table::CAPTION;
    }
}
