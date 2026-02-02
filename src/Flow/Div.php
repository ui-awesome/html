<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<div>` element for grouping flow content.
 *
 * Provides a concrete `<div>` element implementation that returns `Block::DIV` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<div>` element is a generic container with no semantic meaning.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Flow\Div;
 *
 * echo Div::tag()
 *     ->class('container')
 *     ->content('value')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/div
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Div extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<div>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<div>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::DIV;
    }
}
