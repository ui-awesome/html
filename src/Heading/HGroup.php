<?php

declare(strict_types=1);

namespace UIAwesome\Html\Heading;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<hgroup>` element for grouped heading content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Heading\HGroup::tag()
 *     ->content(
 *         \UIAwesome\Html\Heading\H1::tag()->content('Main Title'),
 *         \UIAwesome\Html\Flow\P::tag()->content('Subtitle or tagline')
 *     )
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/hgroup
 * {@see BaseBlock} for the base implementation.
 */
final class HGroup extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<hgroup>` element.
     *
     * @return Block Tag enumeration instance for `<hgroup>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::HGROUP;
    }
}
