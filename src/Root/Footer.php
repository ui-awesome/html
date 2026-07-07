<?php

declare(strict_types=1);

namespace UIAwesome\Html\Root;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<footer>` element for section or page footer content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Root\Footer::tag()
 *     ->class('page-footer')
 *     ->content('© 2026 Company Name')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/footer
 * {@see BaseBlock} for the base implementation.
 */
final class Footer extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<footer>` element.
     *
     * @return Block Tag enumeration instance for `<footer>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::FOOTER;
    }
}
