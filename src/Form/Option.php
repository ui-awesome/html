<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\{CanBeDisabled, CanBeSelected, HasLabel, HasValue};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Values\SelectTag;

/**
 * Renders the HTML `<option>` element for selectable options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Option::tag()
 *     ->content('Dog')
 *     ->value('dog')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/option
 * {@see BaseBlock} for the base implementation.
 */
final class Option extends BaseBlock
{
    use CanBeDisabled;
    use CanBeSelected;
    use HasLabel;
    use HasValue;

    /**
     * Returns the tag enumeration for the `<option>` element.
     *
     * @return SelectTag Tag enumeration instance for `<option>`.
     */
    protected function getTag(): SelectTag
    {
        return SelectTag::OPTION;
    }
}
