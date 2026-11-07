<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<nav>` element for navigation sections.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/nav
 * {@see BaseBlock} for the base implementation.
 */
final class Nav extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<nav>` element.
     *
     * @return Block Tag enumeration instance for `<nav>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::NAV;
    }
}
