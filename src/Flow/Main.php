<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<main>` element for dominant document content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Flow\Main::tag()
 *     ->class('content')
 *     ->content('value')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/main
 * {@see BaseBlock} for the base implementation.
 */
final class Main extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<main>` element.
     *
     * @return Block Tag enumeration instance for `<main>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::MAIN;
    }
}
