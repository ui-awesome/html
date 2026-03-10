<?php

declare(strict_types=1);

namespace UIAwesome\Html\Interactive;

use UIAwesome\Html\Attribute\HasName;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interactive\Attribute\CanBeOpen;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<details>` element for disclosure widgets.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Interactive\Details::tag()
 *     ->name('requirements')
 *     ->open(true)
 *     ->content(\UIAwesome\Html\Interactive\Summary::tag()->content('System requirements')->render())
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/details
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Details extends BaseBlock
{
    use CanBeOpen;
    use HasName;

    /**
     * Returns the tag enumeration for the `<details>` element.
     *
     * @return Block Tag enumeration instance for `<details>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::DETAILS;
    }
}
