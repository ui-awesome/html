<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Values\Type;

/**
 * Renders the HTML `<input type="month">` element.
 *
 * The value uses the 'yyyy-MM' format (for example, '2017-06').
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputMonth::tag()
 *     ->min('2018-03')
 *     ->name('start')
 *     ->value('2018-05')
 *     ->render();
 * echo InputMonth::tag()
 *     ->name('bday-month')
 *     ->value('2001-06')
 *     ->render();
 * echo InputMonth::tag()
 *     ->max('2022-09')
 *     ->min('2022-06')
 *     ->name('month')
 *     ->required(true)
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/month
 * {@see AbstractInputDateTime} for the base implementation.
 */
final class InputMonth extends AbstractInputDateTime
{
    /**
     * Returns the type rendered as the default `type` attribute.
     *
     * @return Type Always {@see Type::MONTH}.
     */
    protected function getType(): Type
    {
        return Type::MONTH;
    }
}
