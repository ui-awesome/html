<?php

declare(strict_types=1);

namespace UIAwesome\Html\Heading;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<h2>` element for second-level section headings.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Heading\H2::tag()
 *     ->class('section-title')
 *     ->content('Section Title')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/Heading_Elements
 * {@see BaseBlock} for the base implementation.
 */
final class H2 extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<h2>` element.
     *
     * @return Block Tag enumeration instance for `<h2>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::H2;
    }
}
