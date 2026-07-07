<?php

declare(strict_types=1);

namespace UIAwesome\Html\Metadata\Values;

/**
 * Represents values for the HTML `shadowrootmode` attribute.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#shadowrootmodee.
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
