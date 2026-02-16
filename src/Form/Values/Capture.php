<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents the values for the HTML `capture` attribute.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/capture
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Capture: string
{
    /**
     * The outward-facing camera and/or microphone should be used.
     */
    case ENVIRONMENT = 'environment';

    /**
     * The user-facing camera and/or microphone should be used.
     */
    case USER = 'user';
}
