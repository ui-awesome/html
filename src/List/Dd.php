<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Lists;

/**
 * Renders the HTML `<dd>` element for description details.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\List\Dd::tag()
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
     * @return Lists Tag enumeration instance for `<dd>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): Lists
    {
        return Lists::DD;
    }
}
