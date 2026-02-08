<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\Form\HasRequired;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Form\Mixin\{CanBeEnclosedByLabel, HasLabel};
use UIAwesome\Html\Interop\{VoidInterface, Voids};
use UIAwesome\Html\Phrasing\Label;
use UnitEnum;

use function is_bool;
use function is_scalar;

/**
 * Represents the HTML `<input type="checkbox">` element.
 *
 * The checkbox is a graphical control element that allows the user to select or deselect one or more independent
 * options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputCheckbox::tag()
 *     ->checked(true)
 *     ->name('terms')
 *     ->value('accepted')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/checkbox
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputCheckbox extends BaseInput
{
    use CanBeAutofocus;
    use CanBeEnclosedByLabel;
    use HasLabel;
    use HasRequired;
    use HasTabindex;
    use HasValue;

    /**
     * Determines the checked state of the checkbox.
     */
    private bool|float|int|string|Stringable|UnitEnum|null $checked = null;

    /**
     * Value to be submitted when the checkbox is not checked.
     *
     * If set, an additional hidden input will be rendered with the same name as the checkbox and this value.
     *
     * This ensures that a value is always submitted for the checkbox, even when it is unchecked.
     */
    private bool|float|int|string|Stringable|UnitEnum|null $uncheckedValue = null;

    /**
     * Sets the `checked` attribute.
     *
     * Usage example:
     * ```php
     * $element->checked(true);
     * $element->checked(false);
     * $element->checked('active')->value('active'); // checked
     * $element->checked('inactive')->value('active'); // unchecked
     * ```
     *
     * @param bool|float|int|string|Stringable|UnitEnum|null $value Checked state.
     *
     * - `true`: Checkbox is checked.
     * - `false`: Checkbox is unchecked.
     * - `null`: Attribute is removed.
     * - `float|int|string|Stringable|UnitEnum`: Checkbox is checked if the value matches the `value` attribute.
     *
     * @return static New instance with the updated `checked` attribute.
     */
    public function checked(bool|float|int|string|Stringable|UnitEnum|null $value): self
    {
        $new = clone $this;
        $new->checked = $value;

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

        /** @var mixed $value */
        $value = $attributes['value'] ?? null;

        if (is_bool($value)) {
            $value = $value ? 1 : 0;
            $attributes['value'] = $value;
        }

        if ($this->checked === true) {
            $attributes['checked'] = true;
        } elseif (is_scalar($this->checked) && is_scalar($value)) {
            $attributes['checked'] = "{$value}" === "{$this->checked}";
        }

        return $attributes;
    }

    /**
     * Set the value that should be submitted when the checkbox is not checked.
     *
     * @param bool|float|int|string|Stringable|UnitEnum|null $value Value to be submitted.
     *
     * @return static New instance with the updated `uncheckedValue` value.
     */
    public function uncheckedValue(bool|float|int|string|Stringable|UnitEnum|null $value): self
    {
        $new = clone $this;
        $new->uncheckedValue = $value;

        return $new;
    }

    /**
     * Returns the tag enumeration for the `<input>` element.
     *
     * @return VoidInterface Tag enumeration instance for `<input>`.
     */
    protected function getTag(): VoidInterface
    {
        return Voids::INPUT;
    }

    /**
     * Returns the default configuration for the input element.
     *
     * @return array Default configuration array with method calls as keys.
     *
     * @phpstan-return array<string, mixed>
     */
    protected function loadDefault(): array
    {
        return [
            'template' => ['{prefix}\n{unchecked}\n{tag}\n{label}\n{suffix}'],
            'type' => [Type::CHECKBOX],
        ] + parent::loadDefault();
    }

    /**
     * Renders the `<input>` element with its attributes.
     *
     * @return string Rendered HTML for the `<input>` element.
     */
    protected function run(): string
    {
        /** @var string|null $id */
        $id = $this->getAttribute('id', null);

        $unchecked = '';

        if ($this->uncheckedValue !== null) {
            /** @phpstan-var string $name */
            $name = $this->getAttribute('name', '');

            $unchecked = InputHidden::tag()
                ->id(null)
                ->name($name)
                ->value($this->uncheckedValue)
                ->render();
        }

        if ($this->notLabel || $this->label === '') {
            return $this->buildElement('', ['{label}' => '', '{unchecked}' => $unchecked]);
        }

        $labelTag = Label::tag()->attributes($this->labelAttributes);

        if ($this->enclosedByLabel === false) {
            if (array_key_exists('for', $this->labelAttributes) === false) {
                $labelTag = $labelTag->for($id);
            }

            $labelTag = $labelTag->content($this->label);

            return $this->buildElement(
                '',
                [
                    '{label}' => $labelTag,
                    '{unchecked}' => $unchecked,
                ],
            );
        }

        $labelTag = $labelTag
            ->html(
                PHP_EOL,
                Html::element($this->getTag(), '', $this->getAttributes()),
                PHP_EOL,
                $this->label,
                PHP_EOL,
            );

        return $this->buildElement(
            '',
            [
                '{tag}' => $labelTag,
                '{label}' => '',
                '{unchecked}' => $unchecked,
            ],
        );
    }
}
