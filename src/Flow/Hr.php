<?php

declare(strict_types=1);

namespace UIAwesome\Html\Flow;

use UIAwesome\Html\Attribute\Global\{HasContentEditable, HasDraggable, HasMicroData, HasSpellcheck, HasTabindex};
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Interop\{VoidInterface, Voids};

/**
 * Represents the HTML `<hr>` element for thematic breaks.
 *
 * Provides a concrete `<hr>` element implementation that returns `Voids::HR` and inherits void-level rendering and
 * global attribute support from {@see BaseVoid}.
 *
 * The `<hr>` element represents a thematic break between paragraph-level elements.
 *
 * Key features.
 * - Supports global HTML attributes via {@see BaseVoid}.
 * - Void element renders without end tag.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Flow\Hr;
 *
 * echo Hr::tag()
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
    use HasContentEditable;
    use HasDraggable;
    use HasMicroData;
    use HasSpellcheck;
    use HasTabindex;

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
