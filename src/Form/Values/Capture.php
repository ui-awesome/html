<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents values for the HTML `capture` attribute.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/capture
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
