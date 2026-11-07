<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Values\Type;

/**
 * Renders the HTML `<input type="time">` element.
 *
 * The value uses the 'hh:mm' format (for example, '14:30').
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
