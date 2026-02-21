<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents values for the HTML `wrap` attribute.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/textarea#wrap
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Wrap: string
{
    /**
     * Represents the `hard` token. The browser automatically inserts line breaks (CR+LF) so no line exceeds the
     * width of the control. The `cols` attribute must be specified.
     */
    case HARD = 'hard';

    /**
     * Represents the `off` token. Like `soft`, but changes appearance to `white-space: pre` so line segments
     * exceeding `cols` are not wrapped. Non-standard.
     */
    case OFF = 'off';

    /**
     * Represents the `soft` token. The browser ensures all line breaks in the value are CR+LF pairs, but no
     * additional line breaks are added. This is the default.
     */
    case SOFT = 'soft';
}
