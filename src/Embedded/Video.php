<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use UIAwesome\Html\Attribute\Element\{HasHeight, HasSrc, HasWidth};
use UIAwesome\Html\Attribute\HasCrossorigin;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Embedded\Attribute\{
    HasAutoplay,
    HasControls,
    HasControlslist,
    HasDisablepictureinpicture,
    HasDisableremoteplayback,
    HasLoop,
    HasMuted,
    HasPlaysinline,
    HasPoster,
    HasPreload,
};
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<video>` element for embedding video content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Embedded\Video::tag()
 *     ->controls(true)
 *     ->src('/media/intro.mp4')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/video
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Video extends BaseBlock
{
    use HasAutoplay;
    use HasControls;
    use HasControlslist;
    use HasCrossorigin;
    use HasDisablepictureinpicture;
    use HasDisableremoteplayback;
    use HasHeight;
    use HasLoop;
    use HasMuted;
    use HasPlaysinline;
    use HasPoster;
    use HasPreload;
    use HasSrc;
    use HasWidth;

    /**
     * Returns the tag enumeration for the `<video>` element.
     *
     * @return Block Tag enumeration instance for `<video>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::VIDEO;
    }
}
