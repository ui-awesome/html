<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Attribute\Values\ElementAttribute;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Contracts\Attribute\SrcInterface;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<input type="image">` element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/image
 */
final class InputImage extends BaseInput implements SrcInterface
{
    use CanBeAutofocus;
    use HasTabindex;

    /**
     * Sets the `alt` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Alternative text for the element, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `alt` attribute.
     */
    public function alt(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::ALT, $value);
    }

    /**
     * Sets the `formaction` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value URL for form submission, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `formaction` attribute.
     */
    public function formaction(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('formaction', $value);
    }

    /**
     * Sets the `formenctype` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Encoding type for form submission, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `formenctype` attribute.
     */
    public function formenctype(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('formenctype', $value);
    }

    /**
     * Sets the `formmethod` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value HTTP method for form submission, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `formmethod` attribute.
     */
    public function formmethod(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('formmethod', $value);
    }

    /**
     * Sets the `formnovalidate` attribute.
     *
     * @param bool|null $value Whether to bypass form validation, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `formnovalidate` attribute.
     */
    public function formnovalidate(bool|null $value): static
    {
        return $this->addAttribute('formnovalidate', $value);
    }

    /**
     * Sets the `formtarget` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Browsing context for form submission response, or `null` to remove
     * the attribute.
     *
     * @return static New instance with the updated `formtarget` attribute.
     */
    public function formtarget(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute('formtarget', $value);
    }

    /**
     * Sets the `height` attribute.
     *
     * @param int|string|Stringable|UnitEnum|null $value Height value in pixels or CSS units, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `height` attribute.
     */
    public function height(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::HEIGHT, $value);
    }

    /**
     * Sets the `src` attribute.
     *
     * @param string|Stringable|UnitEnum|null $value Image source URL or path, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `src` attribute.
     */
    public function src(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::SRC, $value);
    }

    /**
     * Sets the `width` attribute.
     *
     * @param int|string|Stringable|UnitEnum|null $value Width value in pixels or CSS units, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `width` attribute.
     */
    public function width(int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(ElementAttribute::WIDTH, $value);
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
     * set to `image`.
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::IMAGE]];
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
