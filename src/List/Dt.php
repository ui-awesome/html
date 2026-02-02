<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\{BlockInterface, Lists};

/**
 * Represents the HTML `<dt>` element for description terms.
 *
 * Provides a concrete `<dt>` element implementation that returns `Lists::DT` and inherits block-level rendering and
 * global attribute support from {@see BaseBlock}.
 *
 * The `<dt>` element specifies a term in a description or definition list, and as such must be used inside a `<dl>`
 * element. It is usually followed by a `<dd>` element.
 *
 * Key features.
 * - Container element accepts phrasing content.
 * - Supports `begin()`/`end()` rendering via {@see BaseBlock}.
 * - Supports global HTML attributes via {@see BaseBlock}.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\List\Dt;
 *
 * echo Dt::tag()
 *     ->content('Term text')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/dt
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Dt extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<dt>` element.
     *
     * @return BlockInterface Tag enumeration instance for `<dt>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): BlockInterface
    {
        return Lists::DT;
    }
}
