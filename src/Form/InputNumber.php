<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute, Type};
use UIAwesome\Html\Contracts\Attribute\ValueInterface;
use UIAwesome\Html\Contracts\Form\PlaceholderInterface;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<input type="number">` element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/number
 */
final class InputNumber extends BaseInput implements PlaceholderInterface, ValueInterface
{
    use CanBeAutofocus;
    use HasTabindex;
    use HasValue;

    /**
     * Sets the `autocomplete` attribute.
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
     * Sets the `list` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Datalist ID, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `list` attribute.
     */
    public function list(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::LIST, $value);
    }

    /**
     * Sets the `max` attribute.
     *
     * @param float|int|string|Stringable|UnitEnum|null $value Maximum value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `max` attribute.
     */
    public function max(float|int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::MAX, $value);
    }

    /**
     * Sets the `min` attribute.
     *
     * @param float|int|string|Stringable|UnitEnum|null $value Minimum value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `min` attribute.
     */
    public function min(float|int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::MIN, $value);
    }

    /**
     * Sets the `placeholder` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Placeholder text, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `placeholder` attribute.
     */
    public function placeholder(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::PLACEHOLDER, $value);
    }

    /**
     * Sets the `readonly` attribute.
     *
     * @param bool|null $value Readonly state. Use `true` to make readonly, `false` to make editable, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `readonly` attribute.
     */
    public function readonly(bool|null $value): static
    {
        return $this->addAttribute(Attribute::READONLY, $value);
    }

    /**
     * Sets the `required` attribute.
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
     * Sets the `step` attribute.
     *
     * @param float|int|string|Stringable|UnitEnum|null $value Step value. Use 'any' for no stepping restriction, or
     * `null` to remove the attribute.
     *
     * @return static New instance with the updated `step` attribute.
     */
    public function step(float|int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::STEP, $value);
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
     * set to `number`.
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::NUMBER]];
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
