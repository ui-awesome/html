<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{
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
 * Renders the HTML `<input type="url">` element for URL input.
 *
 * The value uses the `https://` format (for example, `https://example.com`).
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputUrl::tag()
 *     ->name('website')
 *     ->pattern('https://.*')
 *     ->placeholder('https://example.com')
 *     ->required(true)
 *     ->size(30)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/url
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputUrl extends BaseInput
{
    use CanBeAutofocus;
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
        return parent::loadDefault() + ['type' => [Type::URL]];
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
