<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{
    CanBeMultiple,
    CanBeReadonly,
    CanBeRequired,
    HasAutocomplete,
    HasForm,
    HasList,
    HasMaxlength,
    HasMinlength,
    HasPattern,
    HasPlaceholder,
    HasSize,
};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasSpellcheck, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\Voids;

/**
 * Renders the HTML `<input type="email">` element.
 *
 * Email inputs let the user enter and edit an email address or, if the `multiple` attribute is specified, a list of
 * email addresses.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputEmail::tag()
 *     ->maxlength(255)
 *     ->name('email')
 *     ->placeholder('hello@example.com')
 *     ->required(true)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/email
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputEmail extends BaseInput
{
    use CanBeAutofocus;
    use CanBeMultiple;
    use CanBeReadonly;
    use CanBeRequired;
    use HasAutocomplete;
    use HasForm;
    use HasList;
    use HasMaxlength;
    use HasMinlength;
    use HasPattern;
    use HasPlaceholder;
    use HasSize;
    use HasSpellcheck;
    use HasTabindex;
    use HasValue;

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
     * @return array Default configuration array with method calls as keys.
     *
     * @phpstan-return array<string, mixed>
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::EMAIL]];
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
