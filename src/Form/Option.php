<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\{CanBeDisabled, CanBeSelected, HasLabel, HasValue};
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Contracts\Attribute\ValueInterface;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Values\SelectTag;
use UIAwesome\Html\Helper\Enum;

use function array_filter;
use function explode;
use function html_entity_decode;
use function implode;
use function in_array;
use function str_replace;
use function strip_tags;

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
final class Option extends BaseBlock implements ValueInterface
{
    use CanBeDisabled;
    use CanBeSelected;
    use HasLabel;
    use HasValue;

    /**
     * Resolves the `selected` attribute against the values selected by the parent element.
     *
     * Usage example:
     * ```php
     * $option = \UIAwesome\Html\Form\Option::tag()
     *     ->value('dog')
     *     ->selectedValues(['dog']);
     * ```
     *
     * @param string[] $values Normalized selected values.
     *
     * @return static New instance with the resolved `selected` attribute.
     *
     * @internal
     */
    public function selectedValues(array $values): static
    {
        return $this->selected(in_array($this->submittedValue(), $values, true));
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

    /**
     * Returns the value the browser submits for this option.
     *
     * Falls back to the option text when the `value` attribute is absent, so selection matching agrees with what the
     * browser would submit. The text is the markup-free content with ASCII whitespace stripped and collapsed.
     *
     * @return string Submitted value.
     *
     * @see https://html.spec.whatwg.org/multipage/form-elements.html#concept-option-value
     */
    private function submittedValue(): string
    {
        $value = $this->getAttribute(ElementAttribute::VALUE);

        if ($value !== null) {
            return Enum::normalizeStringValue($value);
        }

        $text = html_entity_decode(strip_tags($this->getContent()), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $words = explode(' ', str_replace(["\t", "\n", "\f", "\r"], ' ', $text));

        return implode(' ', array_filter($words, static fn(string $word): bool => $word !== ''));
    }
}
