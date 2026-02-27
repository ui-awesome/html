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
use UIAwesome\Html\Interop\Voids;

/**
 * Renders the HTML `<input type="date">` element.
 *
 * The value uses the `yyyy-mm-dd` format (for example, `2017-06-01`).
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputDate::tag()
 *     ->name('birthday')
 *     ->render();
 * echo InputDate::tag()
 *     ->max('2017-04-30')
 *     ->min('2017-04-01')
 *     ->name('party-date')
 *     ->required(true)
 *     ->render();
 * echo InputDate::tag()
 *     ->name('appointment')
 *     ->readonly(true)
 *     ->value('2017-06-01')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/date
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputDate extends BaseInput
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
        return parent::loadDefault() + ['type' => [Type::DATE]];
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
