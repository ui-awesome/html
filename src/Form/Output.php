<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\{HasFor, HasName};
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;
use UnitEnum;

/**
 * Renders the HTML `<output>` element for calculation and action results.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/output
 * {@see BaseInline} for the base implementation.
 */
final class Output extends BaseInline
{
    use HasFor;
    use HasName;

    /**
     * Sets the `form` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Form ID, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `form` attribute.
     */
    public function form(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::FORM, $value);
    }

    /**
     * Returns the tag enumeration for the `<output>` element.
     *
     * @return Inline Tag enumeration instance for `<output>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::OUTPUT;
    }

    /**
     * Renders the `<output>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<output>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
