<?php

declare(strict_types=1);

namespace UIAwesome\Html\Heading;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<h1>` element for top-level section headings.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Heading\H1::tag()
 *     ->class('main-title')
 *     ->content('Main Title')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class H1 extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<h1>` element.
     *
     * @return Block Tag enumeration instance for `<h1>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::H1;
    }
}
