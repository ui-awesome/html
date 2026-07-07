<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents values for the HTML `enctype` attribute of the `<form>` element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form#enctype
 */
enum Enctype: string
{
    /**
     * Represents the `application/x-www-form-urlencoded` token. The default value if the attribute is not specified.
     */
    case APPLICATION_X_WWW_FORM_URLENCODED = 'application/x-www-form-urlencoded';

    /**
     * Represents the `multipart/form-data` token. Use this if the form contains `<input>` elements with
     * `type=file`.
     */
    case MULTIPART_FORM_DATA = 'multipart/form-data';

    /**
     * Represents the `text/plain` token. Useful for debugging purposes.
     */
    case TEXT_PLAIN = 'text/plain';
}
