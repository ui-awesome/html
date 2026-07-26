<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Values\Type;

/**
 * Renders the HTML `<input type="datetime-local">` element.
 *
 * The value uses the 'YYYY-MM-DDTHH:mm' format (for example, '2018-06-12T19:30').
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputDateTimeLocal::tag()
 *     ->name('meeting-time')
 *     ->render();
 * echo InputDateTimeLocal::tag()
 *     ->max('2018-06-14T00:00')
 *     ->min('2018-06-07T00:00')
 *     ->name('party-date')
 *     ->required(true)
 *     ->render();
 * echo InputDateTimeLocal::tag()
 *     ->name('appointment')
 *     ->readonly(true)
 *     ->value('2018-06-12T19:30')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/datetime-local
 * {@see AbstractInputDateTime} for the base implementation.
 */
final class InputDateTimeLocal extends AbstractInputDateTime
{
    /**
     * Returns the type rendered as the default `type` attribute.
     *
     * @return Type Always {@see Type::DATETIME_LOCAL}.
     */
    protected function getType(): Type
    {
        return Type::DATETIME_LOCAL;
    }
}
