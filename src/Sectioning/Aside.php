<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<aside>` element for tangentially related content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Sectioning\Aside::tag()
 *     ->class('sidebar')
 *     ->content('Sidebar content here')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/aside
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Aside extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<aside>` element.
     *
     * @return Block Tag enumeration instance for `<aside>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::ASIDE;
    }
}
