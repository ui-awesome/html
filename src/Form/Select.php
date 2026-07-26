<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use InvalidArgumentException;
use Override;
use Stringable;
use UIAwesome\Html\Attribute\{CanBeDisabled, HasName};
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute};
use UIAwesome\Html\Contracts\Attribute\ValueInterface;
use UIAwesome\Html\Contracts\Form\{FormControlInterface, MultiValueInterface};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Mixin\HasSelectableChildren;
use UIAwesome\Html\Helper\{Enum, Validator};
use UIAwesome\Html\Interop\Block;
use UnitEnum;

use function count;
use function implode;
use function is_array;

/**
 * Renders the HTML `<select>` element for choosing one or more options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Select::tag()
 *     ->name('pets')
 *     ->option(\UIAwesome\Html\Form\Option::tag()->value('dog')->content('Dog'))
 *     ->required(true)
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/select
 * {@see BaseBlock} for the base implementation.
 */
final class Select extends BaseBlock implements FormControlInterface, MultiValueInterface, ValueInterface
{
    use CanBeDisabled;
    use HasName;
    use HasSelectableChildren;

    /**
     * Selected value or values.
     *
     * @var array<mixed>|bool|float|int|string|Stringable|UnitEnum|null
     */
    private array|bool|float|int|string|Stringable|UnitEnum|null $value = null;
    /**
     * Whether {@see value()} was called, distinguishing an unset selection from a `null` selection.
     */
    private bool $valueConfigured = false;

    /**
     * Sets the `autocomplete` attribute.
     *
     * Usage example:
     * ```php
     * $element->autocomplete('on');
     * $element->autocomplete('email');
     * $element->autocomplete('new-password');
     * $element->autocomplete(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Autocomplete value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `autocomplete` attribute.
     */
    public function autocomplete(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::AUTOCOMPLETE, $value);
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
     * Returns the content with every appended option and option group rendered in place.
     *
     * Children are rendered on access, so the value configured through {@see value()} is applied to the current
     * option instances.
     *
     * Usage example:
     * ```php
     * $html = \UIAwesome\Html\Form\Select::tag()
     *     ->option(\UIAwesome\Html\Form\Option::tag()->value('dog')->content('Dog'))
     *     ->getContent();
     * ```
     *
     * @return string Content with the appended children rendered in place.
     */
    #[Override]
    public function getContent(): string
    {
        return $this->renderChildren($this->selectedValues());
    }

    /**
     * Sets the `multiple` attribute.
     *
     * Usage example:
     * ```php
     * $element->multiple(true);
     * $element->multiple(null);
     * ```
     *
     * @param bool|null $value Multiple state. Use `true` to allow multiple values, `false` to disallow, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `multiple` attribute.
     */
    public function multiple(bool|null $value): static
    {
        return $this->addAttribute(Attribute::MULTIPLE, $value);
    }

    /**
     * Appends an `<optgroup>` element to the select.
     *
     * Usage example:
     * ```php
     * $select = \UIAwesome\Html\Form\Select::tag()
     *     ->optgroup(
     *         \UIAwesome\Html\Form\Optgroup::tag()
     *             ->label('Pets')
     *             ->option(\UIAwesome\Html\Form\Option::tag()->value('dog')->content('Dog')),
     *     );
     * ```
     *
     * @param Optgroup $optgroup Optgroup element instance.
     *
     * @return static New instance with the appended optgroup.
     */
    public function optgroup(Optgroup $optgroup): static
    {
        return $this->appendChildren($optgroup);
    }

    /**
     * Appends an `<option>` element to the select.
     *
     * Usage example:
     * ```php
     * $select = \UIAwesome\Html\Form\Select::tag()
     *     ->option(\UIAwesome\Html\Form\Option::tag()->value('dog')->content('Dog'));
     * ```
     *
     * @param Option $option Option element instance.
     *
     * @return static New instance with the appended option.
     */
    public function option(Option $option): static
    {
        return $this->appendChildren($option);
    }

    /**
     * Appends multiple `<option>` elements to the select.
     *
     * Usage example:
     * ```php
     * $select = \UIAwesome\Html\Form\Select::tag()->options(
     *     \UIAwesome\Html\Form\Option::tag()->value('dog')->content('Dog'),
     *     \UIAwesome\Html\Form\Option::tag()->value('cat')->content('Cat'),
     *     \UIAwesome\Html\Form\Option::tag()->value('hamster')->content('Hamster'),
     * );
     * ```
     *
     * @param Option ...$options Option element instances.
     *
     * @return static New instance with the appended options.
     */
    public function options(Option ...$options): static
    {
        return $this->appendChildren(...$options);
    }

    /**
     * Sets the `required` attribute.
     *
     * Usage example:
     * ```php
     * $element->required(true);
     * $element->required(null);
     * ```
     *
     * @param bool|null $value Required state. Use `true` to require a value, `false` to make it optional, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `required` attribute.
     */
    public function required(bool|null $value): static
    {
        return $this->addAttribute(Attribute::REQUIRED, $value);
    }

    /**
     * Sets the `size` attribute.
     *
     * Usage example:
     * ```php
     * $element->size(10);
     * $element->size(50);
     * $element->size(null);
     * ```
     *
     * @param int|string|Stringable|UnitEnum|null $value Size value. Must be '>= 0', or `null` to remove the attribute.
     *
     * @throws InvalidArgumentException if the value is not an integer-like value '>= 0'.
     *
     * @return static New instance with the updated `size` attribute.
     */
    public function size(int|string|Stringable|UnitEnum|null $value): static
    {
        if ($value instanceof UnitEnum) {
            $value = Enum::normalizeValue($value);
        }

        if ($value !== null && Validator::intLike($value) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    Attribute::SIZE->value,
                    'value >= 0',
                ),
            );
        }

        return $this->addAttribute(Attribute::SIZE, $value);
    }

    /**
     * Sets the value or values used to select child options.
     *
     * The selected value is rendering state and is never serialized as a `value` attribute on the `<select>`.
     *
     * Usage example:
     * ```php
     * $select = \UIAwesome\Html\Form\Select::tag()
     *     ->value('cat')
     *     ->options(
     *         \UIAwesome\Html\Form\Option::tag()->value('dog')->content('Dog'),
     *         \UIAwesome\Html\Form\Option::tag()->value('cat')->content('Cat'),
     *     );
     * ```
     *
     * @param array<mixed>|bool|float|int|string|Stringable|UnitEnum|null $value Selected value or values. Must be an
     * `array` or `null` when `multiple` is `true`, and must not hold more than one value otherwise; the constraint is
     * enforced on render.
     *
     * @return static New instance with the updated selected value.
     */
    public function value(array|bool|float|int|string|Stringable|UnitEnum|null $value): static
    {
        $new = clone $this;
        $new->value = $value;
        $new->valueConfigured = true;

        return $new;
    }

    /**
     * Returns the tag enumeration for the `<select>` element.
     *
     * @return Block Tag enumeration instance for `<select>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::SELECT;
    }

    /**
     * Validates the selected value and renders the `<select>` element.
     *
     * @throws InvalidArgumentException if the selected value does not match the `multiple` attribute.
     *
     * @return string Rendered HTML for the `<select>` element.
     */
    #[Override]
    protected function run(): string
    {
        if ($this->isBeginExecuted() === false) {
            $this->validateValue();
        }

        return parent::run();
    }

    /**
     * Returns the normalized selected values, or `null` when no selection was configured.
     *
     * @return string[]|null Normalized selected values.
     */
    private function selectedValues(): array|null
    {
        if ($this->valueConfigured === false) {
            return null;
        }

        if ($this->value === null) {
            return [];
        }

        return Enum::normalizeStringArray(is_array($this->value) ? $this->value : [$this->value]);
    }

    /**
     * Validates the selected value against the `multiple` attribute.
     *
     * A `multiple` select carries an array of values, while a single select carries at most one, since the browser
     * submits only one value and would discard the rest.
     *
     * @throws InvalidArgumentException if the selected value does not match the `multiple` attribute.
     */
    private function validateValue(): void
    {
        if ($this->value === null) {
            return;
        }

        $isMultiple = $this->getAttribute(Attribute::MULTIPLE) === true;
        $isArray = is_array($this->value);

        if ($isMultiple && $isArray === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    Enum::normalizeStringValue($this->value),
                    ElementAttribute::VALUE->value,
                    'array when "multiple" is true',
                ),
            );
        }

        if ($isMultiple === false && $isArray && count($this->value) > 1) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    implode(', ', Enum::normalizeStringArray($this->value)),
                    ElementAttribute::VALUE->value,
                    'single value unless "multiple" is true',
                ),
            );
        }
    }
}
