<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<section>` element for generic standalone sections.
 *
 * Provides a concrete `<section>` element implementation that returns `Block::SECTION` and inherits block-level
 * rendering and global attribute support from {@see BaseBlock}.
 *
 * The `<section>` element represents a generic standalone section of a document, which doesn't have a more specific
 * semantic element to represent it. Sections should always have a heading, with very few exceptions. Examples include:
 * chapters, tabbed pages, content areas with headings, or distinct sections of a document.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Sectioning\Section;
 *
 * echo Section::tag()
 *     ->class('content-section')
 *     ->content('Section content here')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/section
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Section extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<section>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<section>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::SECTION;
    }
}
