<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute, Type};
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Form\Values\Colorspace;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<input type="color">` element.
 *
 * Supports the experimental `alpha` and `colorspace` attributes. Availability and behavior may vary across
 * browsers.
 *
 * The value must be a valid CSS `<color>` value; defaults to '#000000' if omitted or invalid.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputColor::tag()
 *     ->name('head')
 *     ->render();
 * echo InputColor::tag()
 *     ->list('colorsuggestion')
 *     ->name('head')
 *     ->value('#ff0000')
 *     ->render();
 * echo InputColor::tag()
 *     ->alpha(true)
 *     ->colorspace(\UIAwesome\Html\Form\Values\Colorspace::DISPLAY_P3)
 *     ->name('head')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/color
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputColor extends BaseInput
{
    use CanBeAutofocus;
    use HasTabindex;
    use HasValue;

    /**
     * Sets the `alpha` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputColor::tag()
     *     ->alpha(true)
     *     ->render();
     * ```
     *
     * @param bool $value Whether to allow the user to manipulate the color's alpha channel.
     *
     * @return static New instance with the updated `alpha` attribute.
     */
    public function alpha(bool $value): static
    {
        return $this->addAttribute('alpha', $value);
    }

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
     * Sets the `colorspace` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputColor::tag()
     *     ->colorspace(\UIAwesome\Html\Form\Values\Colorspace::DISPLAY_P3)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Color space ('limited-srgb' or 'display-p3'), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `colorspace` attribute.
     *
     * {@see Colorspace} for predefined enum values.
     */
    public function colorspace(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Colorspace::cases(), 'colorspace');

        return $this->addAttribute('colorspace', $value);
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
     * set to `color`.
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::COLOR]];
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
