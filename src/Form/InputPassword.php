<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{
    HasAutocomplete,
    HasForm,
    HasMaxlength,
    HasMinlength,
    HasPattern,
    HasPlaceholder,
    HasReadonly,
    HasRequired,
    HasSize
};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasInputMode, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\{VoidInterface, Voids};

/**
 * Renders the HTML `<input type="password">` element.
 *
 * The element is presented as a one-line plain text editor control in which the text is obscured so that it cannot be
 * read, usually by replacing each character with a symbol such as the asterisk ("*") or a dot ("•").
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
    use HasAutocomplete;
    use HasForm;
    use HasInputMode;
    use HasMaxlength;
    use HasMinlength;
    use HasPattern;
    use HasPlaceholder;
    use HasReadonly;
    use HasRequired;
    use HasSize;
    use HasTabindex;
    use HasValue;

    /**
     * Returns the tag enumeration for the `<input>` element.
     *
     * @return VoidInterface Tag enumeration instance for `<input>`.
     */
    protected function getTag(): VoidInterface
    {
        return Voids::INPUT;
    }

    /**
     * Returns the default configuration for the input element.
     *
     * @return array Default configuration array with method calls as keys.
     *
     * @phpstan-return array<string, mixed>
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
}
