<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Lists};

/**
 * Represents the HTML `<li>` element for list items.
 *
 * Provides a concrete `<li>` element implementation that returns `Lists::LI` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<li>` element is used to represent an item in a list. It must be contained in a parent element: an ordered list
 * (`<ol>`), an unordered list (`<ul>`), or a menu (`<menu>`).
 *
 * Key features.
 * - Container element accepts flow content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 * - Supports the `value` attribute for ordered lists.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\List\Li;
 *
 * echo Li::tag()
 *     ->value(3)
 *     ->content('Third item')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/li
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Li extends BaseBlock
{
    use HasValue;

    /**
     * Returns the tag enumeration for the `<li>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<li>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Lists::LI;
    }
}
