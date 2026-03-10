<?php

declare(strict_types=1);

namespace UIAwesome\Html\Interactive\Values;

/**
 * Represents values for the HTML `closedby` attribute on `<dialog>` elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dialog#closedby
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
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
