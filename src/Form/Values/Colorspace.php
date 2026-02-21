<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents values for the HTML `colorspace` attribute.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/color#colorspace
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Colorspace: string
{
    /**
     * Represents the `display-p3` token.
     */
    case DISPLAY_P3 = 'display-p3';

    /**
     * Represents the `limited-srgb` token.
     */
    case LIMITED_SRGB = 'limited-srgb';
}
