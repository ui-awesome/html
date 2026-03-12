<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use UIAwesome\Html\Attribute\Element\{HasHeight, HasSrc, HasSrcset, HasWidth};
use UIAwesome\Html\Attribute\{HasMedia, HasSizes};
use UIAwesome\Html\Core\Element\BaseVoid;
use UIAwesome\Html\Embedded\Attribute\HasType;
use UIAwesome\Html\Interop\Voids;

/**
 * Renders the HTML `<source>` element for media and responsive image sources.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Embedded\Source::tag()
 *     ->src('/media/intro.webm')
 *     ->type('video/webm')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/source
 * {@see BaseVoid} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Source extends BaseVoid
{
    use HasHeight;
    use HasMedia;
    use HasSizes;
    use HasSrc;
    use HasSrcset;
    use HasType;
    use HasWidth;

    /**
     * Returns the tag enumeration for the `<source>` element.
     *
     * @return Voids Tag enumeration instance for `<source>`.
     *
     * {@see Voids} for valid void-level tags.
     */
    protected function getTag(): Voids
    {
        return Voids::SOURCE;
    }
}
