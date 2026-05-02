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
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Output::tag()
 *     ->content('0')
 *     ->for('price quantity')
 *     ->form('order-form')
 *     ->name('total')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/output
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Output extends BaseInline
{
    use HasFor;
    use HasName;

    /**
     * Sets the `form` attribute.
     *
     * Usage example:
     * ```php
     * $element->form('myForm');
     * $element->form($formId);
     * $element->form(null);
     * ```
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
