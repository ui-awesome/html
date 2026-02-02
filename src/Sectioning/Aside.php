<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<aside>` element for tangentially related content.
 *
 * Provides a concrete `<aside>` element implementation that returns `Block::ASIDE` and inherits block-level rendering
 * and global attribute support from {@see BaseBlock}.
 *
 * The `<aside>` element represents a portion of a document whose content is only indirectly related to the document's
 * main content. Asides are frequently presented as sidebars or call-out boxes.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example.
 * ```php
 * use UIAwesome\Html\Sectioning\Aside;
 *
 * echo Aside::tag()
 *     ->class('sidebar')
 *     ->content('Sidebar content here')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/aside
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Aside extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<aside>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<aside>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::ASIDE;
    }
}
