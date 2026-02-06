<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\{VoidInterface, Voids};

/**
 * Renders the HTML `<hr>` element for thematic breaks.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Flow\Hr::tag()
 *     ->class('divider')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/hr
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Hr extends BaseVoid
{
    /**
     * Returns the tag enumeration for the `<hr>` element.
     *
     * @return VoidInterface Tag enumeration instance for `<hr>`.
     *
     * {@see Voids} for valid void-level tags.
     */
    protected function getTag(): VoidInterface
    {
        return Voids::HR;
    }
}
