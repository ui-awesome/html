<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\{HasAutocomplete, HasForm, HasList};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Form\Attribute\{HasAlpha, HasColorspace};
use UIAwesome\Html\Interop\Voids;

/**
 * Renders the HTML `<input type="color">` element.
 *
 * The value must be a valid CSS `<color>` value; defaults to `#000000` if omitted or invalid.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputColor::tag()
 *     ->name('head')
 *     ->render();
 * echo InputColor::tag()
 *     ->list('colorsuggestion')
 *     ->name('head')
 *     ->value('#ff0000')
 *     ->render();
 * echo InputColor::tag()
 *     ->alpha(true)
 *     ->colorspace(\UIAwesome\Html\Form\Values\Colorspace::DISPLAY_P3)
 *     ->name('head')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/color
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputColor extends BaseInput
{
    use CanBeAutofocus;
    use HasAlpha;
    use HasAutocomplete;
    use HasColorspace;
    use HasForm;
    use HasList;
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
        return parent::loadDefault() + ['type' => [Type::COLOR]];
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
