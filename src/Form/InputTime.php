<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Values\Type;

/**
 * Renders the HTML `<input type="time">` element.
 *
 * The value uses the 'hh:mm' format (for example, '14:30').
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputTime::tag()
 *     ->name('meeting-time')
 *     ->render();
 * echo InputTime::tag()
 *     ->max('18:00')
 *     ->min('09:00')
 *     ->name('alarm')
 *     ->required(true)
 *     ->render();
 * echo InputTime::tag()
 *     ->name('appointment')
 *     ->readonly(true)
 *     ->value('14:30')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/time
 * {@see AbstractInputDateTime} for the base implementation.
 */
final class InputTime extends AbstractInputDateTime
{
    /**
     * Returns the type rendered as the default `type` attribute.
     *
     * @return Type Always {@see Type::TIME}.
     */
    protected function getType(): Type
    {
        return Type::TIME;
    }
}
