<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\Values\{Attribute, Type};
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Helper\Naming;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<input type="file">` element.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputFile::tag()
 *     ->accept('image/png, image/jpeg')
 *     ->name('avatar')
 *     ->render();
 * echo \UIAwesome\Html\Form\InputFile::tag()
 *     ->multiple(true)
 *     ->name('photos')
 *     ->render();
 * echo \UIAwesome\Html\Form\InputFile::tag()
 *     ->capture(\UIAwesome\Html\Form\Values\Capture::USER)
 *     ->name('video')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/file
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputFile extends BaseInput
{
    use CanBeAutofocus;
    use HasTabindex;

    /**
     * Sets the `accept` attribute.
     *
     * Usage example:
     * ```php
     * $element->accept('image/*');
     * $element->accept('.jpg,.png,.pdf');
     * $element->accept('image/jpeg,application/pdf');
     * $element->accept(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Accept value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `accept` attribute.
     */
    public function accept(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::ACCEPT, $value);
    }

    /**
     * Sets the `capture` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputFile::tag()
     *     ->capture('user')
     *     ->render();
     * echo \UIAwesome\Html\Form\InputFile::tag()
     *     ->capture('environment')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Capture value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `capture` attribute.
     */
    public function capture(string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::CAPTURE, $value);
    }

    /**
     * Returns the array of HTML attributes for the element.
     *
     * @return array Attributes array assigned to the element.
     *
     * @return mixed[] Array of attributes, with the `name` attribute modified to include '[]' if the `multiple`
     * attribute is set, and the `value` attribute removed since it is not allowed for `<input type="file">`.
     */
    public function getAttributes(): array
    {
        $attributes = parent::getAttributes();

        $attributes['name'] = $this->generateNameWithMultiple();

        // value attribute is not allowed for the `<input type="file">` element, so we remove it if it exists.
        unset($attributes['value']);

        return $attributes;
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
     * set to `file`.
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::FILE]];
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
     * Generates the name of the input element, adding '[]' if the `multiple` attribute is set.
     *
     * @return string Generated name.
     */
    private function generateNameWithMultiple(): string
    {
        /** @var string $name */
        $name = $this->getAttribute('name', '');
        $isMultiple = $this->getAttribute('multiple', false);

        if ($isMultiple === false) {
            return $name;
        }

        return Naming::generateArrayableName($name);
    }
}
