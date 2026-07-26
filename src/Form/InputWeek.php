<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Values\Type;

/**
 * Renders the HTML `<input type="week">` element.
 *
 * The value uses the 'yyyy-Www' format (for example, '2017-W01').
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputWeek::tag()
 *     ->name('vacation-week')
 *     ->render();
 * echo InputWeek::tag()
 *     ->max('2018-W26')
 *     ->min('2018-W18')
 *     ->name('camp-week')
 *     ->required(true)
 *     ->render();
 * echo InputWeek::tag()
 *     ->name('report-week')
 *     ->readonly(true)
 *     ->value('2024-W15')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/week
 * {@see AbstractInputDateTime} for the base implementation.
 */
final class InputWeek extends AbstractInputDateTime
{
    /**
     * Returns the type rendered as the default `type` attribute.
     *
     * @return Type Always {@see Type::WEEK}.
     */
    protected function getType(): Type
    {
        return Type::WEEK;
    }
}
