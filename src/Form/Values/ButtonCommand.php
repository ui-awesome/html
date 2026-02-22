<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Values;

/**
 * Represents values for the HTML `command` attribute of the `<button>` element.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/button#command
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
enum ButtonCommand: string
{
    /**
     * Represents the `close` token. Closes the targeted `<dialog>` element.
     */
    case CLOSE = 'close';

    /**
     * Represents the `hide-popover` token. Hides a showing popover element.
     */
    case HIDE_POPOVER = 'hide-popover';

    /**
     * Represents the `request-close` token. Triggers a `cancel` event on the targeted `<dialog>`, allowing
     * `preventDefault()` to block closing.
     */
    case REQUEST_CLOSE = 'request-close';

    /**
     * Represents the `show-modal` token. Shows the targeted `<dialog>` element as a modal.
     */
    case SHOW_MODAL = 'show-modal';

    /**
     * Represents the `show-popover` token. Shows a hidden popover element.
     */
    case SHOW_POPOVER = 'show-popover';

    /**
     * Represents the `toggle-popover` token. Toggles the visibility of the targeted popover element.
     */
    case TOGGLE_POPOVER = 'toggle-popover';
}
