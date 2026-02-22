<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `command` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/button#command
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasCommand
{
    /**
     * Sets the `command` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Button::tag()
     *     ->command('show-modal')
     *     ->render();
     * echo \UIAwesome\Html\Form\Button::tag()
     *     ->command(\UIAwesome\Html\Form\Values\ButtonCommand::SHOW_MODAL)
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Command value, or `null` to remove the attribute. Accepts
     * predefined values (`show-modal`, `close`, `request-close`, `show-popover`, `hide-popover`, `toggle-popover`) or
     * any custom value prefixed with `--`.
     *
     * @return static New instance with the updated `command` attribute.
     *
     * {@see \UIAwesome\Html\Form\Values\ButtonCommand} for predefined enum values.
     */
    public function command(string|Stringable|UnitEnum|null $value): static
    {
        return $this->setAttribute('command', $value);
    }
}
