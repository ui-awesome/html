<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{
    CanBeReadonly,
    CanBeRequired,
    HasAutocomplete,
    HasForm,
    HasList,
    HasMax,
    HasMin,
    HasStep,
};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\{VoidInterface, Voids};

/**
 * Renders the HTML `<input type="month">` element.
 *
 * The value uses the `yyyy-MM` format (for example, `2017-06`).
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputMonth::tag()
 *     ->min('2018-03')
 *     ->name('start')
 *     ->value('2018-05')
 *     ->render();
 * echo InputMonth::tag()
 *     ->name('bday-month')
 *     ->value('2001-06')
 *     ->render();
 * echo InputMonth::tag()
 *     ->max('2022-09')
 *     ->min('2022-06')
 *     ->name('month')
 *     ->required(true)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/month
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputMonth extends BaseInput
{
    use CanBeAutofocus;
    use CanBeReadonly;
    use CanBeRequired;
    use HasAutocomplete;
    use HasForm;
    use HasList;
    use HasMax;
    use HasMin;
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
        return parent::loadDefault() + ['type' => [Type::MONTH]];
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
