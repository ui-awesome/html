<?php

declare(strict_types=1);

namespace UIAwesome\Html\Embedded\Values;

/**
 * Represents values for the HTML `kind` attribute on `<track>` elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/track#kind
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Kind: string
{
    /**
     * Closed captions text track (`captions`).
     */
    case CAPTIONS = 'captions';

    /**
     * Chapter titles text track (`chapters`).
     */
    case CHAPTERS = 'chapters';

    /**
     * Audio descriptions text track (`descriptions`).
     */
    case DESCRIPTIONS = 'descriptions';

    /**
     * Script metadata text track (`metadata`).
     */
    case METADATA = 'metadata';

    /**
     * Subtitles text track (`subtitles`).
     */
    case SUBTITLES = 'subtitles';
}
