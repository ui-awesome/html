<?php

declare(strict_types=1);

namespace UIAwesome\Html\Heading;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<hgroup>` element for grouping heading content.
 *
 * Provides a concrete `<hgroup>` element implementation that returns `Block::HGROUP` and inherits block-level rendering
 * and global attribute support from {@see BaseBlock}.
 *
 * The `<hgroup>` element represents a heading and related content. It groups a single `<h1>`–`<h6>` element with one or
 * more `<p>` elements. The element itself has no impact on the document outline.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Flow\P;
 * use UIAwesome\Html\Heading\H1;
 * use UIAwesome\Html\Heading\HGroup;
 *
 * echo HGroup::tag()
 *     ->content(
 *         H1::tag()->content('Main Title'),
 *         P::tag()->content('Subtitle or tagline')
 *     )
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/hgroup
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class HGroup extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<hgroup>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<hgroup>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::HGROUP;
    }
}
