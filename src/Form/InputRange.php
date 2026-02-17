<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{
    HasAutocomplete,
    HasForm,
    HasList,
    HasMax,
    HasMin,
    HasStep
};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\{VoidInterface, Voids};

/**
 * Renders the HTML `<input type="range">` element.
 *
 * The `<input type="range">` element lets the user specify a numeric value which must be no less than a given value,
 * and no more than another given value.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputRange::tag()
 *     ->max(11)
 *     ->min(0)
 *     ->name('volume')
 *     ->render();
 * echo InputRange::tag()
 *     ->max(100)
 *     ->min(0)
 *     ->name('cowbell')
 *     ->step(10)
 *     ->value(90)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/range
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputRange extends BaseInput
{
    use CanBeAutofocus;
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
        return parent::loadDefault() + ['type' => [Type::RANGE]];
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
