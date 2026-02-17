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
 * Renders the HTML `<input type="datetime-local">` element.
 *
 * The value uses the `YYYY-MM-DDTHH:mm` format (for example, `2018-06-12T19:30`).
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputDateTimeLocal::tag()
 *     ->name('meeting-time')
 *     ->render();
 * echo InputDateTimeLocal::tag()
 *     ->max('2018-06-14T00:00')
 *     ->min('2018-06-07T00:00')
 *     ->name('party-date')
 *     ->required(true)
 *     ->render();
 * echo InputDateTimeLocal::tag()
 *     ->name('appointment')
 *     ->readonly(true)
 *     ->value('2018-06-12T19:30')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/datetime-local
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputDateTimeLocal extends BaseInput
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
        return parent::loadDefault() + ['type' => [Type::DATETIME_LOCAL]];
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
