<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute, Type};
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<input type="month">` element.
 *
 * The value uses the 'yyyy-MM' format (for example, '2017-06').
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputMonth::tag()
 *     ->min('2018-03')
 *     ->name('start')
 *     ->value('2018-05')
 *     ->render();
 * echo InputMonth::tag()
 *     ->name('bday-month')
 *     ->value('2001-06')
 *     ->render();
 * echo InputMonth::tag()
 *     ->max('2022-09')
 *     ->min('2022-06')
 *     ->name('month')
 *     ->required(true)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/month
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputMonth extends BaseInput
{
    use CanBeAutofocus;
    use HasTabindex;
    use HasValue;

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
     * Sets the `list` attribute.
     *
     * Usage example:
     * ```php
     * $element->list('suggestions');
     * $element->list('countries-list');
     * $element->list(null);
     * ```
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
     * Usage example:
     * ```php
     * $element->max(100);
     * $element->max('2024-12-31');
     * $element->max('23:59');
     * $element->max(null);
     * ```
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
     * Usage example:
     * ```php
     * $element->min(0);
     * $element->min('2024-01-01');
     * $element->min('08:00');
     * $element->min(null);
     * ```
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
     * Sets the `readonly` attribute.
     *
     * Usage example:
     * ```php
     * $element->readonly(true);
     * $element->readonly(null);
     * ```
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
     * Sets the `step` attribute.
     *
     * Usage example:
     * ```php
     * $element->step(1);
     * $element->step(0.5);
     * $element->step('any');
     * $element->step(null);
     * ```
     *
     * @param float|int|string|Stringable|UnitEnum|null $value Step value. Use `any` for no stepping restriction, or
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
     * set to `month`.
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::MONTH]];
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
