<?php

declare(strict_types=1);

namespace UIAwesome\Html\Interactive;

use Stringable;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\{Button, Form};
use UIAwesome\Html\Form\Values\{ButtonCommand, Method};
use UIAwesome\Html\Interactive\Attribute\{CanBeOpen, HasClosedby};
use UIAwesome\Html\Interop\Block;

/**
 * Renders the HTML `<dialog>` element for modal and non-modal dialogs.
 *
 * Supports the experimental `closedby` attribute. Availability and behavior may vary across browsers.
 *
 * Usage example:
 * ```php
 * use UIAwesome\Html\Interactive\Dialog;
 * use UIAwesome\Html\Interactive\Values\Closedby;
 *
 * echo Dialog::tag()
 *     ->closedby(Closedby::CLOSEREQUEST)
 *     ->open(true)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dialog
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Dialog extends BaseBlock
{
    use CanBeOpen;
    use HasClosedby;

    /**
     * Prepends a dialog-close button.
     *
     * Accepts a `Button` instance for full control, or text content that is automatically wrapped in a `Button`
     * element.
     *
     * Usage examples:
     * ```php
     * $dialog = Dialog::tag()->closeButton('Close');
     * $dialog = Dialog::tag()->closeButton(Button::tag()->content('Cancel'));
     * $dialog = Dialog::tag()->closeButton(null);
     * ```
     *
     * @param Button|string|Stringable|null $button Button instance, button label text, or `null` to skip.
     *
     * If the dialog has an `id` attribute, the button is wired with `command="close"` and
     * `commandfor="{id}"` (MDN invoker command pattern). Otherwise, the button is wrapped in
     * `<form method="dialog">`.
     *
     * @return static New instance with the prepended close button.
     */
    public function closeButton(Button|string|Stringable|null $button): static
    {
        if ($button === null) {
            return $this;
        }

        if (!$button instanceof Button) {
            $button = Button::tag()->content($button);
        }

        /** @phpstan-var string $dialogId */
        $dialogId = $this->getAttribute('id', '');

        $closeMarkup = $dialogId !== ''
            ? $button
                ->command(ButtonCommand::CLOSE)
                ->commandfor($dialogId)
                ->render()
            : Form::tag()
                ->method(Method::DIALOG)
                ->html($button)
                ->render();

        $new = clone $this;
        $new->content = $closeMarkup . ($new->content === '' ? '' : "\n{$new->content}");

        return $new;
    }

    /**
     * Returns the tag enumeration for the `<dialog>` element.
     *
     * @return Block Tag enumeration instance for `<dialog>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::DIALOG;
    }
}
