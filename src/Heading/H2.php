<?php

declare(strict_types=1);

namespace UIAwesome\Html\Heading;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<h2>` element for section headings.
 *
 * Provides a concrete `<h2>` element implementation that returns `Block::H2` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<h2>` element represents the second level of section headings. `<h1>` is the highest section level and `<h6>` is
 * the lowest. By default, all heading elements create a block-level box in the layout.
 *
 * Key features.
 * - Accepts phrasing content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Heading\H2;
 *
 * echo H2::tag()
 *     ->class('section-title')
 *     ->content('Section Title')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class H2 extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<h2>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<h2>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::H2;
    }
}
