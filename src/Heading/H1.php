<?php

declare(strict_types=1);

namespace UIAwesome\Html\Heading;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<h1>` element for the highest section heading.
 *
 * Provides a concrete `<h1>` element implementation that returns `Block::H1` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<h1>` element represents the highest level of section headings. `<h1>` is the highest section level and `<h6>`
 * is the lowest. By default, all heading elements create a block-level box in the layout.
 *
 * Key features.
 * - Accepts phrasing content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Heading\H1;
 *
 * echo H1::tag()
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
     * @return BlockInterface Tag enumeration instance for `<h1>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::H1;
    }
}
