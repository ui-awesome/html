<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Values;

/**
 * Represents values for the HTML `shadowrootmode` attribute.
 *
 * Defines the supported `shadowrootmode` tokens as enum cases.
 *
 * Key features.
 * - Enum values map to `'open'` and `'closed'` tokens.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootmode
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum ShadowRootMode: string
{
    /**
     * Hides the internal shadow root DOM from JavaScript (`closed`).
     */
    case CLOSED = 'closed';

    /**
     * Exposes the internal shadow root DOM for JavaScript (`open`).
     */
    case OPEN = 'open';
}
