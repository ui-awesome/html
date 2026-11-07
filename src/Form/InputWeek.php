<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Values\Type;

/**
 * Renders the HTML `<input type="week">` element.
 *
 * The value uses the 'yyyy-Www' format (for example, '2017-W01').
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
