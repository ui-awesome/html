<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Values\Type;

/**
 * Renders the HTML `<input type="date">` element.
 *
 * The value uses the 'yyyy-mm-dd' format (for example, '2017-06-01').
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/date
 * {@see AbstractInputDateTime} for the base implementation.
 */
final class InputDate extends AbstractInputDateTime
{
    /**
     * Returns the type rendered as the default `type` attribute.
     *
     * @return Type Always {@see Type::DATE}.
     */
    protected function getType(): Type
    {
        return Type::DATE;
    }
}
