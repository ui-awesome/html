<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\{CanBeDisabled, HasName};
use UIAwesome\Html\Attribute\Global\{HasAutocapitalize, HasAutocorrect};
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Contracts\Form\{FormControlInterface, PlaceholderInterface};
use UIAwesome\Html\Core\Element\BaseBlock;
use UIAwesome\Html\Form\Mixin\{HasMaxlength, HasMinlength, HasPlaceholder};
use UIAwesome\Html\Form\Values\Wrap;
use UIAwesome\Html\Helper\Validator;
use UIAwesome\Html\Interop\Block;
use UnitEnum;

/**
 * Renders the HTML `<textarea>` element for multiline plain-text input.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\TextArea::tag()
 *     ->name('comment')
 *     ->rows(5)
 *     ->cols(33)
 *     ->placeholder('Enter your comment here')
 *     ->render();
 * ```
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/textarea
 * {@see BaseBlock} for the base implementation.
 */
final class TextArea extends BaseBlock implements FormControlInterface, PlaceholderInterface
{
    use CanBeDisabled;
    use HasAutocapitalize;
    use HasAutocorrect;
    use HasMaxlength;
    use HasMinlength;
    use HasName;
    use HasPlaceholder;

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
     * Sets the `cols` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\TextArea::tag()
     *     ->cols(20)
     *     ->render();
     * ```
     *
     * @param int|string|null $value Visible width in average character widths (positive integer), or `null` to remove
     * the attribute.
     *
     * @throws InvalidArgumentException if the provided value is not a positive integer.
     *
     * @return static New instance with the updated `cols` attribute.
     */
    public function cols(int|string|null $value): static
    {
        return $this->addAttribute(
            'cols',
            self::intLikeAttribute($value, 'cols', 1, null, 'value > 0'),
        );
    }

    /**
     * Sets the `dirname` attribute.
     *
     * Usage example:
     * ```php
     * $element->dirname('comment-dir');
     * $element->dirname('text-direction');
     * $element->dirname(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Dirname value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `dirname` attribute.
     */
    public function dirname(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::DIRNAME, $value);
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
     * Sets the `rows` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\TextArea::tag()
     *     ->rows(5)
     *     ->render();
     * ```
     *
     * @param int|string|null $value Number of visible text lines (positive integer), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not a positive integer.
     *
     * @return static New instance with the updated `rows` attribute.
     */
    public function rows(int|string|null $value): static
    {
        return $this->addAttribute(
            'rows',
            self::intLikeAttribute($value, 'rows', 1, null, 'value > 0'),
        );
    }

    /**
     * Sets the `wrap` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\TextArea::tag()
     *     ->wrap('hard')
     *     ->render();
     * echo \UIAwesome\Html\Form\TextArea::tag()
     *     ->wrap(\UIAwesome\Html\Form\Values\Wrap::SOFT)
     *     ->render();
     * ```
     *
     * @param string|UnitEnum|null $value Line-wrapping behavior ('hard', 'soft', or 'off'), or `null` to remove the
     * attribute.
     *
     * @throws InvalidArgumentException if the provided value is not valid.
     *
     * @return static New instance with the updated `wrap` attribute.
     *
     * {@see Wrap} for predefined enum values.
     */
    public function wrap(string|UnitEnum|null $value): static
    {
        Validator::oneOf($value, Wrap::cases(), 'wrap');

        return $this->addAttribute('wrap', $value);
    }

    /**
     * Returns the tag enumeration for the `<textarea>` element.
     *
     * @return Block Tag enumeration instance for `<textarea>`.
     *
     * {@see Block} for valid block-level tags.
     */
    protected function getTag(): Block
    {
        return Block::TEXT_AREA;
    }
}
