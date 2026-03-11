<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Values;

/**
 * Represents values for the HTML `controlslist` attribute on media elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio#controlslist
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Controlslist: string
{
    /**
     * Hides the download control (`nodownload`).
     */
    case NODOWNLOAD = 'nodownload';

    /**
     * Hides the fullscreen control (`nofullscreen`).
     */
    case NOFULLSCREEN = 'nofullscreen';

    /**
     * Hides remote playback controls (`noremoteplayback`).
     */
    case NOREMOTEPLAYBACK = 'noremoteplayback';
}
