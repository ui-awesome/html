<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<section>` element for standalone document sections.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/section
 * {@see BaseBlock} for the base implementation.
 */
final class Section extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<section>` element.
     *
     * @return Block Tag enumeration instance for `<section>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::SECTION;
    }
}
