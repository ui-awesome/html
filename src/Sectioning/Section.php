<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Renders the HTML `<section>` element for standalone document sections.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Sectioning\Section::tag()
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
