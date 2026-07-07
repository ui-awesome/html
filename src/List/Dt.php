<?php

declare(strict_types=1);

namespace UIAwesome\Html\List;

use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Interop\Lists;

/**
 * Renders the HTML `<dt>` element for description terms.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\List\Dt::tag()
 *     ->content('Term text')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/dt
 * {@see BaseBlock} for the base implementation.
 */
final class Dt extends BaseBlock
{
    /**
     * Returns the tag enumeration for the `<dt>` element.
     *
     * @return Lists Tag enumeration instance for `<dt>`.
     *
     * {@see Lists} for valid list-level tags.
     */
    protected function getTag(): Lists
    {
        return Lists::DT;
    }
}
