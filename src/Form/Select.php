<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\{CanBeDisabled, HasName};
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Helper\{Enum, Validator};
use UIAwesome\Html\Interop\Block;
use UnitEnum;

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
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/select
 * {@see BaseBlock} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Select extends BaseBlock
{
    use CanBeDisabled;
    use HasName;

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
     * @param Optgroup $optgroup Optgroup element instance.
     *
     * @return static New instance with the appended optgroup.
     */
    public function optgroup(Optgroup $optgroup): static
    {
        return $this->html($optgroup, "\n");
    }

    /**
     * Appends an `<option>` element to the select.
     *
     * @param Option $option Option element instance.
     *
     * @return static New instance with the appended option.
     */
    public function option(Option $option): static
    {
        return $this->html($option, "\n");
    }

    /**
     * Appends multiple `<option>` elements to the select from value-label pairs.
     *
     * Usage example:
     * ```php
     * $select = \UIAwesome\Html\Form\Select::tag()->options(
     *     ['dog', 'Dog'],
     *     ['cat', 'Cat'],
     *     ['hamster', 'Hamster'],
     * );
     * ```
     *
     * @param array{0: string, 1: string|Stringable} ...$items Arrays of '[value, label]' pairs.
     *
     * @return static New instance with the appended options.
     */
    public function options(array ...$items): static
    {
        $select = $this;

        foreach ($items as $item) {
            $select = $select->option(Option::tag()->value($item[0])->content($item[1]));
        }

        return $select;
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
}
