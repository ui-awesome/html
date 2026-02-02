<?php

declare(strict_types=1);

namespace UIAwesome\Html\Sectioning;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{Block, BlockInterface};

/**
 * Represents the HTML `<nav>` element for navigation sections.
 *
 * Provides a concrete `<nav>` element implementation that returns `Block::NAV` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<nav>` element represents a section of a page whose purpose is to provide navigation links, either within the
 * current document or to other documents. Common examples of navigation sections are menus, tables of contents, and
 * indexes.
 *
 * Key features.
 * - Container element accepts child content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example.
 * ```php
 * use UIAwesome\Html\Sectioning\Nav;
 *
 * echo Nav::tag()
 *     ->class('main-menu')
 *     ->content('Navigation links here')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/nav
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Nav extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<nav>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<nav>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Block::NAV;
    }
}
