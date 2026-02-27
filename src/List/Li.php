<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Lists;

/**
 * Renders the HTML `<li>` element for list items.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\List\Li::tag()
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
     * @return Lists Tag enumeration instance for `<li>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): Lists
    {
        return Lists::LI;
    }
}
