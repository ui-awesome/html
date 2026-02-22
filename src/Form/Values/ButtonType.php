<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents values for the HTML `type` attribute of the `<button>` element.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/button#type
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum ButtonType: string
{
    /**
     * Represents the `button` token. The button has no default behavior, and does nothing when pressed by default.
     */
    case BUTTON = 'button';

    /**
     * Represents the `reset` token. The button resets all the controls to their initial values.
     */
    case RESET = 'reset';

    /**
     * Represents the `submit` token. The button submits the form data to the server. This is the default if the
     * attribute is not specified for buttons associated with a `<form>`.
     */
    case SUBMIT = 'submit';
}
