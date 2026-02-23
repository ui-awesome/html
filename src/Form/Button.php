<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use InvalidArgumentException;
use UIAwesome\Html\Attribute\{CanBeDisabled, HasName, HasValue};
use UIAwesome\Html\Attribute\Element\{HasPopoverTarget, HasPopoverTargetAction};
use UIAwesome\Html\Attribute\Form\HasForm;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Form\Attribute\{
    HasCommand,
    HasCommandfor,
    HasFormaction,
    HasFormenctype,
    HasFormmethod,
    HasFormnovalidate,
    HasFormtarget,
};
use UIAwesome\Html\Form\Values\ButtonType;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\{Inline, InlineInterface};
use UnitEnum;

/**
 * Renders the HTML `<button>` element.
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
    use HasCommand;
    use HasCommandfor;
    use HasForm;
    use HasFormaction;
    use HasFormenctype;
    use HasFormmethod;
    use HasFormnovalidate;
    use HasFormtarget;
    use HasName;
    use HasPopoverTarget;
    use HasPopoverTargetAction;
    use HasTabindex;
    use HasValue;

    /**
     * Suffix appended to the element `id` when `aria-describedby` is set to `true`.
     *
     * An empty string falls back to `'-help'` during rendering.
     */
    protected string $ariaDescribedBySuffix = '';

    /**
     * Sets the suffix appended to the element `id` when `aria-describedby` is set to `true`.
     *
     * @param string $value Suffix to append to the element `id` for `aria-describedby`. Defaults to `'-help'`.
     *
     * @return static New instance with the updated `ariaDescribedBySuffix` value.
     */
    public function ariaDescribedBySuffix(string $value): static
    {
        $new = clone $this;
        $new->ariaDescribedBySuffix = $value;

        return $new;
    }

    /**
     * Returns the array of HTML attributes for the element.
     *
     * @return array Attributes array assigned to the element.
     *
     * @phpstan-return mixed[]
     */
    public function getAttributes(): array
    {
        $attributes = parent::getAttributes();

        /** @phpstan-var string|null $id */
        $id = $this->getAttribute('id', null);
        $ariaDescribedBy = $this->getAttribute('aria-describedby', null);

        $ariaDescribedBySuffix = $this->ariaDescribedBySuffix === '' ? '-help' : "-{$this->ariaDescribedBySuffix}";

        if ($ariaDescribedBy === true || $ariaDescribedBy === 'true') {
            $attributes['aria-describedby'] = $id !== null ? "{$id}{$ariaDescribedBySuffix}" : null;
        }

        return $attributes;
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
     * @param string|UnitEnum|null $value Button type (`button`, `reset`, `submit`), or `null` to remove the attribute.
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

        return $this->setAttribute('type', $value);
    }

    /**
     * Returns the tag enumeration for the `<button>` element.
     *
     * @return InlineInterface Tag enumeration instance for `<button>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): InlineInterface
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
