<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Helper\CSSClass;
use UIAwesome\Html\Phrasing\Label;
use UnitEnum;

/**
 * Defines one value and label rendered by a checkbox or radio list.
 *
 * The item carries no name, id, or checked state: {@see AbstractChoiceList} derives them from the list and passes them
 * in on render.
 *
 * Usage example:
 * ```php
 * $item = \UIAwesome\Html\Form\ChoiceItem::tag()
 *     ->label('Email')
 *     ->labelClass('choice-label')
 *     ->value('email');
 * ```
 *
 * {@see CheckboxList} and {@see RadioList} for the lists rendering the items.
 */
final class ChoiceItem
{
    /**
     * Label text, encoded on render.
     */
    private string|Stringable $label = '';
    /**
     * @var mixed[] Attributes applied to the item label.
     */
    private array $labelAttributes = [];
    /**
     * Submitted value, or `null` to remove the attribute.
     */
    private bool|float|int|string|Stringable|UnitEnum|null $value = null;

    /**
     * Sets the item label.
     *
     * Usage example:
     * ```php
     * $item->label('Email');
     * ```
     *
     * @param string|Stringable $value Label text, encoded on render.
     *
     * @return self New instance with the updated label.
     */
    public function label(string|Stringable $value): self
    {
        $new = clone $this;
        $new->label = $value;

        return $new;
    }

    /**
     * Sets attributes applied to the item label.
     *
     * Merges with the attributes already configured, so consecutive calls accumulate.
     *
     * Usage example:
     * ```php
     * $item->labelAttributes(['class' => 'choice-label']);
     * $item->labelAttributes(['data-item' => 'email']);
     * ```
     *
     * @param mixed[] $values Label attributes indexed by attribute name.
     *
     * @return self New instance with the updated label attributes.
     */
    public function labelAttributes(array $values): self
    {
        $new = clone $this;
        $new->labelAttributes = [...$new->labelAttributes, ...$values];

        return $new;
    }

    /**
     * Adds a CSS class to the item label.
     *
     * Usage example:
     * ```php
     * $item->labelClass('choice-label');
     * $item->labelClass('replacement', true);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Class name, or `null` to remove the attribute.
     * @param bool $override Whether to replace the existing classes instead of merging them.
     *
     * @return self New instance with the updated label class.
     */
    public function labelClass(string|Stringable|UnitEnum|null $value, bool $override = false): self
    {
        $new = clone $this;
        CSSClass::add($new->labelAttributes, $value, $override);

        return $new;
    }

    /**
     * Renders the item using an atomic HTML checkbox or radio control.
     *
     * @param InputCheckbox|InputRadio $input Input element instance created by the list.
     * @param mixed[] $attributes Attributes applied to the item input.
     * @param string|null $id Item identifier shared by the input and its label, or `null` to omit both.
     * @param string|null $name Name applied to the item input, or `null` to omit the attribute.
     * @param array<mixed>|bool|float|int|string|Stringable|UnitEnum|null $checked Values determining the checked state.
     * @param bool $enclosedByLabel Whether the input is wrapped inside its `<label>`.
     *
     * @return string Rendered HTML for the item input and its label.
     *
     * @internal
     */
    public function render(
        InputCheckbox|InputRadio $input,
        array $attributes,
        string|null $id,
        string|null $name,
        array|bool|float|int|string|Stringable|UnitEnum|null $checked,
        bool $enclosedByLabel,
    ): string {
        $input = $input
            ->attributes($attributes)
            ->checked($checked)
            ->id($id)
            ->name($name)
            ->value($this->value);

        $label = Label::tag()
            ->attributes($this->labelAttributes)
            ->for($id);

        return $enclosedByLabel
            ? $label->html($input->render())->content($this->label)->render()
            : $input->render() . "\n" . $label->content($this->label)->render();
    }

    /**
     * Creates a choice item.
     *
     * Usage example:
     * ```php
     * $item = \UIAwesome\Html\Form\ChoiceItem::tag();
     * ```
     *
     * @return self New item instance.
     */
    public static function tag(): self
    {
        return new self();
    }

    /**
     * Sets the submitted item value.
     *
     * Usage example:
     * ```php
     * $item->value('email');
     * $item->value(null);
     * ```
     *
     * @param bool|float|int|string|Stringable|UnitEnum|null $value Submitted value, or `null` to remove the attribute.
     *
     * @return self New instance with the updated value.
     */
    public function value(bool|float|int|string|Stringable|UnitEnum|null $value): self
    {
        $new = clone $this;
        $new->value = $value;

        return $new;
    }
}
