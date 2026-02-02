<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Lists};

/**
 * Represents the HTML `<dd>` element for description details.
 *
 * Provides a concrete `<dd>` element implementation that returns `Lists::DD` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<dd>` element provides the description, definition, or value for the preceding term (`<dt>`) in a description
 * list (`<dl>`).
 *
 * Key features.
 * - Container element accepts flow content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\List\Dd;
 *
 * echo Dd::tag()
 *     ->content('Description text')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/dd
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Dd extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<dd>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<dd>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Lists::DD;
    }
}
