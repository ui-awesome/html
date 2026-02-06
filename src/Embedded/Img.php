<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use UIAwesome\Html\Attribute\Element\{
    HasAlt,
    HasDecoding,
    HasHeight,
    HasLoading,
    HasReferrerpolicy,
    HasSrc,
    HasSrcset,
    HasUsemap,
    HasWidth,
};
use UIAwesome\Html\Attribute\{HasCrossorigin, HasFetchpriority, HasSizes};
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Embedded\Attribute\{HasElementtiming, HasIsmap};
use UIAwesome\Html\Interop\{VoidInterface, Voids};

/**
 * Renders the HTML `<img>` element for embedding images.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Embedded\Img::tag()
 *     ->src('image.jpg')
 *     ->alt('A beautiful landscape')
 *     ->width(800)
 *     ->height(600)
 *     ->loading('lazy')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/img
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Img extends BaseVoid
{
    use HasAlt;
    use HasCrossorigin;
    use HasDecoding;
    use HasElementtiming;
    use HasFetchpriority;
    use HasHeight;
    use HasIsmap;
    use HasLoading;
    use HasReferrerpolicy;
    use HasSizes;
    use HasSrc;
    use HasSrcset;
    use HasUsemap;
    use HasWidth;

    /**
     * Returns the tag enumeration for the `<img>` element.
     *
     * @return VoidInterface Tag enumeration instance for `<img>`.
     *
     * {@see Voids} for valid void-level tags.
     */
    protected function getTag(): VoidInterface
    {
        return Voids::IMG;
    }
}
