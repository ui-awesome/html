<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\{CanBeDisabled, HasName, HasValue};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute, PopoverTargetAction};
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Form\Values\ButtonType;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Inline;
use UnitEnum;

/**
 * Renders the HTML `<button>` element.
 *
 * Supports the experimental `command` and `commandfor` attributes. Availability and behavior may vary across browsers.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Button::tag()
 *     ->class('btn btn-primary')
 *     ->content('Submit')
 *     ->type(\UIAwesome\Html\Form\Values\ButtonType::SUBMIT)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/button
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Button extends BaseInline
{
    use CanBeAutofocus;
    use CanBeDisabled;
    use HasName;
    use HasTabindex;
    use HasValue;

    /**
     * Sets the `command` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Button::tag()
     *     ->command('show-modal')
     *     ->render();
     * echo \UIAwesome\Html\Form\Button::tag()
     *     ->command(\UIAwesome\Html\Form\Values\ButtonCommand::SHOW_MODAL)
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Command value, or `null` to remove the attribute. Accepts
     * predefined values ('show-modal', 'close', 'request-close', 'show-popover', 'hide-popover', 'toggle-popover') or
     * any custom value prefixed with '--'.
     *
     * @return static New instance with the updated `command` attribute.
     *
     * {@see \UIAwesome\Html\Form\Values\ButtonCommand} for predefined enum values.
     */
    public function command(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('command', $value);
    }

    /**
     * Sets the `commandfor` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Button::tag()
     *     ->commandfor('my-dialog')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value ID of the element to control, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `commandfor` attribute.
     */
    public function commandfor(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('commandfor', $value);
    }

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
     * Sets the `popovertarget` attribute.
     *
     * Usage example:
     * ```php
     * $element->popoverTarget('popover-id');
     * $element->popoverTarget($targetId);
     * $element->popoverTarget(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Popover target ID, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `popovertarget` attribute.
     */
    public function popoverTarget(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::POPOVERTARGET, $value);
    }

    /**
     * Sets the `popovertargetaction` attribute.
     *
     * Usage example:
     * ```php
     * $element->popoverTargetAction('toggle');
     * $element->popoverTargetAction($action);
     * $element->popoverTargetAction(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Popover target action ('hide', 'show', 'toggle'), or `null` to
     * remove the attribute.
     *
     * @throws InvalidArgumentException If the provided value is not valid.
     *
     * @return static New instance with the updated `popovertargetaction` attribute.
     */
    public function popoverTargetAction(string|Stringable|UnitEnum|null $value): static
    {
        Validator::oneOf($value, PopoverTargetAction::cases(), ElementAttribute::POPOVERTARGETACTION);

        return $this->addAttribute(ElementAttribute::POPOVERTARGETACTION, $value);
    }

    /**
     * Sets the `type` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Button::tag()
     *     ->type('submit')
     *     ->render();
     * echo \UIAwesome\Html\Form\Button::tag()
     *     ->type(\UIAwesome\Html\Form\Values\ButtonType::SUBMIT)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Button type ('button', 'reset', 'submit'), or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `type` attribute.
     *
     * {@see ButtonType} for predefined enum values.
     */
    public function type(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, ButtonType::cases(), 'type');

        return $this->addAttribute('type', $value);
    }

    /**
     * Returns the tag enumeration for the `<button>` element.
     *
     * @return Inline Tag enumeration instance for `<button>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::BUTTON;
    }

    /**
     * Renders the `<button>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<button>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
