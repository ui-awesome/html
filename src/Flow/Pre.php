<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<pre>` element for preformatted text.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Flow\Pre::tag()
 *     ->class('listing')
 *     ->content('var_dump($value);')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/pre
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Pre extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<pre>` element.
     *
     * @return Block Tag enumeration instance for `<pre>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::PRE;
    }
}
