<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<p>` element for paragraphs.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Flow\P::tag()
 *     ->class('lead')
 *     ->content('Hello')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/p
 * {@see BaseBlock} for the base implementation.
 */
final class P extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<p>` element.
     *
     * @return Block Tag enumeration instance for `<p>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::P;
    }
}
