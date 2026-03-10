<?php

declare(strict_types=1);

namespace UIAwesome\Html\Interactive;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<summary>` element for disclosure summaries.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Interactive\Summary::tag()
 *     ->content('Overview')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/summary
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Summary extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<summary>` element.
     *
     * @return Block Tag enumeration instance for `<summary>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::SUMMARY;
    }
}
