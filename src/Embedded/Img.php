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
 * Represents the HTML `<img>` element for embedding images.
 *
 * Provides a concrete `<img>` element implementation that returns `Voids::IMG` and inherits void-level rendering and
 * global attribute support from {@see BaseVoid}.
 *
 * The `<img>` element embeds an image into the document.
 *
 * Key features.
 * - Supports global HTML attributes via {@see BaseVoid}.
 * - Supports image-specific attributes: `alt`, `src`, `srcset`, `sizes`, `width`, `height`, `loading`, `decoding`,
 *   `crossorigin`, `fetchpriority`, `referrerpolicy`, `ismap`, `usemap`, and `elementtiming`.
 * - Void element renders without end tag.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Embedded\Img;
 *
 * echo Img::tag()
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
