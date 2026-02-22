<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents values for the HTML `method` attribute of the `<form>` element.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form#method
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum Method: string
{
    /**
     * Represents the `dialog` token. When the form is inside a `<dialog>`, closes the dialog and causes a submit
     * event to be fired on submission, without submitting data or clearing the form.
     */
    case DIALOG = 'dialog';

    /**
     * Represents the `get` token. The form data is appended to the `action` URL with a `?` separator. This is the
     * default value.
     */
    case GET = 'get';

    /**
     * Represents the `post` token. The form data is sent as the request body.
     */
    case POST = 'post';
}
