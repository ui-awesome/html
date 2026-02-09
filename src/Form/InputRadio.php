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
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Interop\{VoidInterface, Voids};
use UIAwesome\Html\Phrasing\Label;
use UnitEnum;

use function is_array;
use function is_bool;
use function is_scalar;

/**
 * Represents the HTML `<input type="radio">` element.
 *
 * The radio button is a graphical control element that allows the user to choose only one of a predefined set of mutually
 * exclusive options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputRadio::tag()
 *     ->checked(true)
 *     ->name('gender')
 *     ->value('female')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/radio
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputRadio extends BaseInput
{
    use CanBeAutofocus;
    use CanBeEnclosedByLabel;
    use HasLabel;
    use HasRequired;
    use HasTabindex;
    use HasValue;

    /**
     * Determines the checked state of the radio.
     *
     * @phpstan-var mixed[]|bool|float|int|string|Stringable|UnitEnum|null $checked
     */
    private array|bool|float|int|string|Stringable|UnitEnum|null $checked = null;

    /**
     * Value to be submitted when the radio is not checked.
     *
     * If set, an additional hidden input will be rendered with the same name as the radio and this value.
     *
     * This ensures that a value is always submitted for the radio, even when it is unchecked.
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
     * @param array|bool|float|int|string|Stringable|UnitEnum|null $value Checked state.
     *
     * - `array`: Radio is checked if the value is in the array.
     * - `false`: Radio is unchecked.
     * - `true`: Radio is checked.
     * - `float|int|string|Stringable|UnitEnum`: Radio is checked if the value matches the `value` attribute.
     * - `null`: Attribute is removed.
     *
     * @return static New instance with the updated `checked` attribute.
     *
     * @phpstan-param mixed[]|bool|float|int|string|Stringable|UnitEnum|null $value
     */
    public function checked(array|bool|float|int|string|Stringable|UnitEnum|null $value): self
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
        return $this->buildAttributes(parent::getAttributes());
    }

    /**
     * Set the value that should be submitted when the radio is not checked.
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
            'type' => [Type::RADIO],
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

    /**
     * Builds the attributes for the `<input>` element.
     *
     * This method normalizes the `value` attribute and determines the `checked` state based on the current value and
     * the configured checked options.
     *
     * @param array $attributes Initial attributes array.
     *
     * @return array Updated attributes array with the `checked` attribute if applicable.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-return mixed[]
     */
    private function buildAttributes(array $attributes): array
    {
        if (isset($attributes['value']) && is_bool($attributes['value'])) {
            $attributes['value'] = $attributes['value'] ? 1 : 0;
        }

        $checked = $this->checked;

        $normalizedChecked = is_array($checked)
            ? Enum::normalizeArray($checked)
            : Enum::normalizeValue($checked);

        if ($normalizedChecked === false || $normalizedChecked === null) {
            return $attributes;
        }

        $value = $attributes['value'] ?? null;

        if ($normalizedChecked === true) {
            $attributes['checked'] = true;

            return $attributes;
        }

        $valueStr = is_scalar($value) ? (string) $value : '';

        if (is_array($normalizedChecked) === false) {
            $attributes['checked'] = $valueStr === "{$normalizedChecked}";

            return $attributes;
        }

        $attributes['checked'] = false;

        foreach ($normalizedChecked as $item) {
            if (is_scalar($item) && "{$item}" === $valueStr) {
                $attributes['checked'] = true;
            }
        }

        return $attributes;
    }
}
