<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasInputMode, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\{Attribute, Type};
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Helper\{Enum, Validator};
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<input type="password">` element.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputPassword::tag()
 *     ->name('password')
 *     ->placeholder('Password')
 *     ->required()
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/password
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputPassword extends BaseInput
{
    use CanBeAutofocus;
    use HasInputMode;
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
     * Sets the `maxlength` attribute.
     *
     * Usage example:
     * ```php
     * $element->maxlength(50);
     * $element->maxlength(255);
     * $element->maxlength(null);
     * ```
     *
     * @param int|string|Stringable|UnitEnum|null $value Maximum length. Must be '>= 0', or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the value is not an integer-like value '>= 0'.
     *
     * @return static New instance with the updated `maxlength` attribute.
     */
    public function maxlength(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(
            Attribute::MAXLENGTH,
            self::intLikeAttribute($value, Attribute::MAXLENGTH),
        );
    }

    /**
     * Sets the `minlength` attribute.
     *
     * Usage example:
     * ```php
     * $element->minlength(3);
     * $element->minlength(8);
     * $element->minlength(null);
     * ```
     *
     * @param int|string|Stringable|UnitEnum|null $value Minimum length. Must be '>= 0', or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the value is not an integer-like value '>= 0'.
     *
     * @return static New instance with the updated `minlength` attribute.
     */
    public function minlength(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(
            Attribute::MINLENGTH,
            self::intLikeAttribute($value, Attribute::MINLENGTH),
        );
    }

    /**
     * Sets the `pattern` attribute.
     *
     * Usage example:
     * ```php
     * $element->pattern('[0-9]{3}-[0-9]{2}-[0-9]{4}');
     * $element->pattern('[a-z]+');
     * $element->pattern(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Pattern value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `pattern` attribute.
     */
    public function pattern(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::PATTERN, $value);
    }

    /**
     * Sets the `placeholder` attribute.
     *
     * Usage example:
     * ```php
     * $element->placeholder('Enter your email');
     * $element->placeholder('for example, John Doe');
     * $element->placeholder(null);
     * ```
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
        return $this->addAttribute(
            Attribute::SIZE,
            self::intLikeAttribute($value, Attribute::SIZE),
        );
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
     * set to `password`.
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::PASSWORD]];
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

    /**
     * Validates an integer-like attribute value greater than or equal to zero.
     *
     * @param int|string|Stringable|UnitEnum|null $value Attribute value.
     * @param Attribute $attribute Attribute name.
     *
     * @throws InvalidArgumentException if the value is not an integer-like value greater than or equal to zero.
     *
     * @return int|string|Stringable|null Normalized attribute value.
     */
    private static function intLikeAttribute(
        int|string|Stringable|UnitEnum|null $value,
        Attribute $attribute,
    ): int|string|Stringable|null {
        if ($value instanceof UnitEnum) {
            $value = Enum::normalizeValue($value);
        }

        if ($value !== null && Validator::intLike($value) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    $attribute->value,
                    'value >= 0',
                ),
            );
        }

        return $value;
    }
}
