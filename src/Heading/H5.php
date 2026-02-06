<?php

declare(strict_types=1);

namespace UIAwesome\Html\Heading;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Renders the HTML `<h5>` element for fifth-level section headings.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Heading\H5::tag()
 *     ->class('subsection-title')
 *     ->content('Subsection Title')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class H5 extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<h5>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<h5>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::H5;
    }
}
