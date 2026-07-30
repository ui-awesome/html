<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use BackedEnum;
use Override;
use Stringable;
use UIAwesome\Html\Attribute\HasName;
use UIAwesome\Html\Attribute\Values\{ElementAttribute, GlobalAttribute};
use UIAwesome\Html\Contracts\Form\{CheckedStateInterface, ChoiceListInterface, FormControlInterface};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Helper\{AttributeBag, CSSClass, Enum};
use UIAwesome\Html\Interop\Block;
use UnitEnum;

use function array_values;
use function implode;
use function is_string;

/**
 * Provides shared immutable rendering behavior for checkbox and radio lists.
 *
 * Renders every {@see ChoiceItem} as an atomic input paired with a `<label>`, wrapped in a container element that
 * carries the list attributes. Selection is configured on the list through {@see checked()}, never on the items.
 *
 * {@see CheckboxList} for the checkbox implementation.
 * {@see RadioList} for the radio implementation.
 */
abstract class AbstractChoiceList extends BaseBlock implements
    CheckedStateInterface,
    ChoiceListInterface,
    FormControlInterface
{
    use HasName;

    /**
     * Values determining which items are checked.
     *
     * @var array<mixed>|bool|float|int|string|Stringable|UnitEnum|null
     */
    private array|bool|float|int|string|Stringable|UnitEnum|null $checked = null;
    /**
     * Whether every item input and its text are enclosed by the item label.
     */
    private bool $enclosedByLabel = false;
    /**
     * @var mixed[] Attributes applied to every item input.
     */
    private array $itemAttributes = [];
    /**
     * @var mixed[] Attributes applied to every item container.
     */
    private array $itemContainerAttributes = [];
    /**
     * Tag enclosing each item input and label, or `false` to render them without a wrapper.
     */
    private BackedEnum|false $itemContainerTag = false;
    /**
     * @var mixed[] Default attributes applied to every item label.
     */
    private array $itemLabelAttributes = [];
    /**
     * @var list<ChoiceItem> Items rendered by the list.
     */
    private array $items = [];
    /**
     * Value submitted when no list item is selected.
     */
    private bool|float|int|string|Stringable|UnitEnum|null $uncheckedValue = null;

    /**
     * Creates the atomic input used for each item.
     *
     * @return InputCheckbox|InputRadio Input element instance rendered for every item.
     */
    abstract protected function createInput(): InputCheckbox|InputRadio;

    /**
     * Returns whether item names use array notation.
     *
     * @return bool `true` when every item input is named `name[]`, `false` when items share the plain list name.
     */
    abstract protected function usesArrayName(): bool;

    /**
     * Sets the values determining which items are checked.
     *
     * Usage example:
     * ```php
     * $list->checked('email');
     * $list->checked(['email', 'sms']);
     * $list->checked(null);
     * ```
     *
     * @param array<mixed>|bool|float|int|string|Stringable|UnitEnum|null $value Checked values.
     *
     * - `array`: Every item whose value is in the array is checked.
     * - `false`: No item is checked.
     * - `true`: Every item is checked.
     * - `float|int|string|Stringable|UnitEnum`: The item whose value matches is checked.
     * - `null`: No item is checked.
     *
     * @return static New instance with the updated checked values.
     */
    public function checked(array|bool|float|int|string|Stringable|UnitEnum|null $value): static
    {
        $new = clone $this;
        $new->checked = $value;

        return $new;
    }

    /**
     * Configures whether every item input and its text are enclosed by the item label.
     *
     * Usage example:
     * ```php
     * $list->enclosedByLabel();
     * $list->enclosedByLabel(false);
     * ```
     *
     * @param bool $value Enclosure state. Use `true` to wrap the input inside its `<label>`, `false` to render the
     * input and the label as siblings.
     *
     * @return static New instance with the updated label enclosure state.
     */
    public function enclosedByLabel(bool $value = true): static
    {
        $new = clone $this;
        $new->enclosedByLabel = $value;

        return $new;
    }

    /**
     * Identifies this control as a list so field wrappers render a group label instead of a `for` label.
     *
     * Usage example:
     * ```php
     * if ($list->isList()) {
     *     // Render a group label instead of a label bound to a single control.
     * }
     * ```
     *
     * @return true Always `true`.
     *
     * @codeCoverageIgnore
     */
    public function isList(): true
    {
        return true;
    }

    /**
     * Sets attributes applied to every item input.
     *
     * Merges with the attributes already configured, so consecutive calls accumulate.
     *
     * Usage example:
     * ```php
     * $list->itemAttributes(['class' => 'choice']);
     * $list->itemAttributes(['data-state' => 'ready']);
     * ```
     *
     * @param mixed[] $values Input attributes indexed by attribute name.
     *
     * @return static New instance with the updated item attributes.
     */
    public function itemAttributes(array $values): static
    {
        $new = clone $this;
        $new->itemAttributes = [...$new->itemAttributes, ...$values];

        return $new;
    }

    /**
     * Sets attributes applied to the container enclosing every item input and label.
     *
     * @param mixed[] $values Container attributes indexed by attribute name.
     *
     * @return static New instance with the updated item container attributes.
     */
    public function itemContainerAttributes(array $values): static
    {
        $new = clone $this;
        AttributeBag::setMany($new->itemContainerAttributes, $values);

        return $new;
    }

    /**
     * Adds CSS classes to the container enclosing every item input and label.
     *
     * @param mixed[]|string|Stringable|UnitEnum|null $value Classes to add, or `null` to keep the current class list.
     * @param bool $override Whether to replace the current class list instead of appending.
     *
     * @return static New instance with the updated item container classes.
     */
    public function itemContainerClass(
        array|string|Stringable|UnitEnum|null $value,
        bool $override = false,
    ): static {
        $new = clone $this;
        CSSClass::add($new->itemContainerAttributes, $value, $override);

        return $new;
    }

    /**
     * Sets the tag enclosing every item input and label.
     *
     * @param BackedEnum|false $value Item container tag, or `false` to render items without wrappers.
     *
     * @return static New instance with the updated item container tag.
     */
    public function itemContainerTag(BackedEnum|false $value): static
    {
        $new = clone $this;
        $new->itemContainerTag = $value;

        return $new;
    }

    /**
     * Sets default attributes applied to every item label.
     *
     * Attributes configured directly on a {@see ChoiceItem} take precedence, while CSS classes are appended.
     *
     * @param mixed[] $values Label attributes indexed by attribute name.
     *
     * @return static New instance with the updated item label attributes.
     */
    public function itemLabelAttributes(array $values): static
    {
        $new = clone $this;
        AttributeBag::setMany($new->itemLabelAttributes, $values);

        return $new;
    }

    /**
     * Adds CSS classes to every item label.
     *
     * @param mixed[]|string|Stringable|UnitEnum|null $value Classes to add, or `null` to keep the current class list.
     * @param bool $override Whether to replace the current class list instead of appending.
     *
     * @return static New instance with the updated item label classes.
     */
    public function itemLabelClass(
        array|string|Stringable|UnitEnum|null $value,
        bool $override = false,
    ): static {
        $new = clone $this;
        CSSClass::add($new->itemLabelAttributes, $value, $override);

        return $new;
    }

    /**
     * Replaces the items rendered by the list.
     *
     * Usage example:
     * ```php
     * $list->items(
     *     \UIAwesome\Html\Form\ChoiceItem::tag()->value('email')->label('Email'),
     *     \UIAwesome\Html\Form\ChoiceItem::tag()->value('sms')->label('SMS'),
     * );
     * ```
     *
     * @param ChoiceItem ...$items Item instances rendered in order.
     *
     * @return static New instance with the replacement items.
     */
    public function items(ChoiceItem ...$items): static
    {
        $new = clone $this;
        $new->items = array_values($items);

        return $new;
    }

    /**
     * Sets the value submitted when no list item is selected.
     *
     * Renders a hidden input carrying the list name before the items, and is skipped when the list has no name.
     *
     * Usage example:
     * ```php
     * $list->uncheckedValue('0');
     * $list->uncheckedValue(null);
     * ```
     *
     * The hidden input always carries the plain list name, never the `name[]` form used by {@see CheckboxList} items,
     * so that a checked item overwrites the fallback under PHP's query-string parsing: `name=0&name[]=1` yields
     * `['1']`, while `name[]=0&name[]=1` would keep the fallback as `['0', '1']`. Consumers that do not apply that
     * bracket normalization, such as the `FormData` API, receive `name` and `name[]` as separate keys.
     *
     * @param bool|float|int|string|Stringable|UnitEnum|null $value Fallback value, or `null` to omit the hidden input.
     *
     * @return static New instance with the updated unchecked value.
     */
    public function uncheckedValue(bool|float|int|string|Stringable|UnitEnum|null $value): static
    {
        $new = clone $this;
        $new->uncheckedValue = $value;

        return $new;
    }

    /**
     * Returns the tag enumeration for the list container.
     *
     * @return Block Tag enumeration instance for `<div>`.
     */
    protected function getTag(): Block
    {
        return Block::DIV;
    }

    /**
     * Renders the list container with its content, the unchecked input, and every item.
     *
     * The `name` attribute is transferred to the item inputs instead of being serialized on the container.
     *
     * @return string Rendered HTML for the choice list.
     */
    #[Override]
    protected function run(): string
    {
        if ($this->isBeginExecuted()) {
            return parent::run();
        }

        $id = $this->normalizeIdentifier($this->getAttribute(GlobalAttribute::ID));
        $name = $this->normalizeIdentifier($this->getAttribute(ElementAttribute::NAME));
        $inputName = $name !== null && $this->usesArrayName() ? "{$name}[]" : $name;

        $content = [];

        if ($this->uncheckedValue !== null && $name !== null) {
            $content[] = InputHidden::tag()
                ->name($name)
                ->value($this->uncheckedValue)
                ->render();
        }

        foreach ($this->items as $index => $item) {
            $content[] = $this->renderItemContainer(
                $item->render(
                    $this->createInput(),
                    $this->itemAttributes,
                    $id === null ? null : "{$id}-{$index}",
                    $inputName,
                    $this->checked,
                    $this->enclosedByLabel,
                    $this->itemLabelAttributes,
                ),
            );
        }

        return Html::element(
            $this->getTag(),
            $this->getContent() . implode("\n", $content),
            $this->containerAttributes(),
        );
    }

    /**
     * Returns the opening tag for begin/end rendering.
     *
     * @return string Opening HTML tag for the list container.
     */
    #[Override]
    protected function runBegin(): string
    {
        return Html::begin($this->getTag(), $this->containerAttributes());
    }

    /**
     * Returns the attributes serialized on the list container.
     *
     * The `name` attribute is transferred to the item inputs, so it is never serialized on the container, which is
     * not a submitting element.
     *
     * @return mixed[] Attributes serialized on the container.
     */
    private function containerAttributes(): array
    {
        $attributes = $this->getAttributes();

        unset($attributes[ElementAttribute::NAME->value]);

        return $attributes;
    }

    /**
     * Normalizes a container identifier to the string transferred to the item inputs.
     *
     * Accepts the types allowed by {@see HasId::id()} and {@see HasName::name()}; any other value assigned through
     * {@see addAttribute()} is not a supported identifier and yields `null`.
     *
     * @param mixed $value Identifier assigned to the container.
     *
     * @return string|null Normalized identifier, or `null` when the value is not a supported identifier type.
     */
    private function normalizeIdentifier(mixed $value): string|null
    {
        return match (true) {
            is_string($value) => $value,
            $value instanceof Stringable, $value instanceof UnitEnum => Enum::normalizeStringValue($value),
            default => null,
        };
    }

    /**
     * Renders an optional container around one item input and label.
     */
    private function renderItemContainer(string $content): string
    {
        return $this->itemContainerTag === false
            ? $content
            : Html::element($this->itemContainerTag, $content, $this->itemContainerAttributes);
    }
}
