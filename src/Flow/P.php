<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<p>` element for grouping paragraphs of text.
 *
 * Provides a concrete `<p>` element implementation that returns `Block::P` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<p>` element represents a paragraph of text.
 *
 * Key features.
 * - Paragraph element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Flow\P;
 *
 * echo P::tag()
 *     ->class('lead')
 *     ->content('Hello')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/p
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class P extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<p>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<p>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::P;
    }
}
