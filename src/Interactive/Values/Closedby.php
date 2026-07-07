<?php

declare(strict_types=1);

namespace UIAwesome\Html\Interactive\Values;

/**
 * Represents values for the HTML `closedby` attribute on `<dialog>` elements.
 *
 * Experimental HTML attribute. Availability and behavior may vary across browsers.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dialog#closedby
 */
enum Closedby: string
{
    /**
     * Dialog can be dismissed by any supported mechanism (`any`).
     */
    case ANY = 'any';

    /**
     * Dialog can be dismissed by a close request (`closerequest`).
     */
    case CLOSEREQUEST = 'closerequest';

    /**
     * Dialog can only be dismissed by developer-defined mechanisms (`none`).
     */
    case NONE = 'none';
}
