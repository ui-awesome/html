<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<div>` element for grouping flow content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Flow\Div::tag()
 *     ->class('container')
 *     ->content('value')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/div
 * {@see BaseBlock} for the base implementation.
 */
final class Div extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<div>` element.
     *
     * @return Block Tag enumeration instance for `<div>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::DIV;
    }
}
