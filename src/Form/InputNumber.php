<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{
    HasAutocomplete,
    HasForm,
    HasList,
    HasMax,
    HasMin,
    HasPlaceholder,
    HasReadonly,
    HasRequired,
    HasStep
};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\{VoidInterface, Voids};

/**
 * Renders the HTML `<input type="number">` element.
 *
 * The `<input type="number">` elements are used to let the user enter a number. They include built-in validation to
 * reject non-numerical entries.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputNumber::tag()
 *     ->name('quantity')
 *     ->min(1)
 *     ->max(5)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/number
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputNumber extends BaseInput
{
    use CanBeAutofocus;
    use HasAutocomplete;
    use HasForm;
    use HasList;
    use HasMax;
    use HasMin;
    use HasPlaceholder;
    use HasReadonly;
    use HasRequired;
    use HasStep;
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
        return parent::loadDefault() + ['type' => [Type::NUMBER]];
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
