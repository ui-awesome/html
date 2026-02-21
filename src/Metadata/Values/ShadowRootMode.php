<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Values;

/**
 * Represents values for the HTML `shadowrootmode` attribute.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootmode
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum ShadowRootMode: string
{
    /**
     * Represents the `closed` token.
     */
    case CLOSED = 'closed';

    /**
     * Represents the `open` token.
     */
    case OPEN = 'open';
}
