<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<input type="submit">` element.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputSubmit::tag()
 *     ->class('btn btn-primary')
 *     ->value('Save')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/submit
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputSubmit extends BaseInput
{
    use CanBeAutofocus;
    use HasTabindex;
    use HasValue;

    /**
     * Sets the `formaction` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputSubmit::tag()
     *     ->formaction('/submit')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value URL for form submission, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `formaction` attribute.
     */
    public function formaction(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('formaction', $value);
    }

    /**
     * Sets the `formenctype` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputSubmit::tag()
     *     ->formenctype('multipart/form-data')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Encoding type for form submission, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `formenctype` attribute.
     */
    public function formenctype(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('formenctype', $value);
    }

    /**
     * Sets the `formmethod` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputSubmit::tag()
     *     ->formmethod('post')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value HTTP method for form submission, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `formmethod` attribute.
     */
    public function formmethod(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('formmethod', $value);
    }

    /**
     * Sets the `formnovalidate` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputSubmit::tag()
     *     ->formnovalidate(true)
     *     ->render();
     * ```
     *
     * @param bool|null $value Whether to bypass form validation, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `formnovalidate` attribute.
     */
    public function formnovalidate(bool|null $value): static
    {
        return $this->addAttribute('formnovalidate', $value);
    }

    /**
     * Sets the `formtarget` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputSubmit::tag()
     *     ->formtarget('_blank')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Browsing context for form submission response, or `null` to remove
     * the attribute.
     *
     * @return static New instance with the updated `formtarget` attribute.
     */
    public function formtarget(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('formtarget', $value);
    }

    /**
     * Returns the tag enumeration for the `<input>` element.
     *
     * @return Voids Tag enumeration instance for `<input>`.
     */
    protected function getTag(): Voids
    {
        return Voids::INPUT;
    }

    /**
     * Returns the default configuration for the input element.
     *
     * @return array<string, mixed> Default configuration for the input element, including the default `type` attribute
     * set to `submit`.
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::SUBMIT]];
    }

    /**
     * Renders the `<input>` element with its attributes.
     *
     * @return string Rendered HTML for the `<input>` element.
     */
    protected function run(): string
    {
        return $this->buildElement();
    }
}
