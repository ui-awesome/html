<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\{Attribute, Type};
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\Voids;
use UnitEnum;

/**
 * Renders the HTML `<input type="hidden">` element.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputHidden::tag()
 *     ->name('csrf_token')
 *     ->value('1234567890')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/hidden
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputHidden extends BaseInput
{
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
     * set to `hidden`.
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::HIDDEN]];
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
