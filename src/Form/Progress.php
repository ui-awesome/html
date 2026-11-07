<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Contracts\Attribute\ValueInterface;
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;
use UnitEnum;

/**
 * Renders the HTML `<progress>` element as a progress indicator.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/progress
 * {@see BaseInline} for the base implementation.
 */
final class Progress extends BaseInline implements ValueInterface
{
    use HasValue;

    /**
     * Sets the `max` attribute.
     *
     * @param float|int|string|Stringable|UnitEnum|null $value Maximum value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `max` attribute.
     */
    public function max(float|int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::MAX, $value);
    }

    /**
     * Returns the tag enumeration for the `<progress>` element.
     *
     * @return Inline Tag enumeration instance for `<progress>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::PROGRESS;
    }

    /**
     * Renders the `<progress>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<progress>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
