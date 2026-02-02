<?php

declare(strict_types=1);

namespace UIAwesome\Html\Heading;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<h6>` element for the lowest section heading.
 *
 * Provides a concrete `<h6>` element implementation that returns `Block::H6` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<h6>` element represents the sixth and lowest level of section headings. `<h1>` is the highest section level and
 * `<h6>` is the lowest. By default, all heading elements create a block-level box in the layout.
 *
 * Key features.
 * - Accepts phrasing content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Heading\H6;
 *
 * echo H6::tag()
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
final class H6 extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<h6>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<h6>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::H6;
    }
}
