<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Values;

/**
 * Represents values for the HTML `preload` attribute on media elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/audio#preload
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Preload: string
{
    /**
     * Advises that the full media file may be loaded (`auto`).
     */
    case AUTO = 'auto';

    /**
     * Advises that only metadata should be loaded (`metadata`).
     */
    case METADATA = 'metadata';
    /**
     * Advises that the media should not be preloaded (`none`).
     */
    case NONE = 'none';
}
