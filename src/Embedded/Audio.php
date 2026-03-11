<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded;

use UIAwesome\Html\Attribute\Element\HasSrc;
use UIAwesome\Html\Attribute\HasCrossorigin;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Embedded\Attribute\{
    HasAutoplay,
    HasControls,
    HasControlslist,
    HasDisableremoteplayback,
    HasLoop,
    HasMuted,
    HasPreload,
};
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<audio>` element for embedding audio content.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Embedded\Audio::tag()
 *     ->controls(true)
 *     ->src('/media/podcast.mp3')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Audio extends BaseBlock
{
    use HasAutoplay;
    use HasControls;
    use HasControlslist;
    use HasCrossorigin;
    use HasDisableremoteplayback;
    use HasLoop;
    use HasMuted;
    use HasPreload;
    use HasSrc;

    /**
     * Returns the tag enumeration for the `<audio>` element.
     *
     * @return Block Tag enumeration instance for `<audio>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::AUDIO;
    }
}
