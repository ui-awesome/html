<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\{CanBeDisabled, CanBeSelected, HasLabel, HasValue};
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Values\SelectTag;
use UIAwesome\Html\Helper\Enum;

use function in_array;

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
     * Resolves the `selected` attribute against the values selected by the parent element.
     *
     * @param string[] $values Normalized selected values.
     *
     * @return static New instance with the resolved `selected` attribute.
     *
     * @internal
     */
    public function selectedValues(array $values): static
    {
        $value = $this->getAttribute(ElementAttribute::VALUE);

        return $this->selected($value !== null && in_array(Enum::normalizeStringValue($value), $values, true));
    }

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
