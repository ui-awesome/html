<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\HasForm;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Form\Attribute\{
    HasFormaction,
    HasFormenctype,
    HasFormmethod,
    HasFormnovalidate,
    HasFormtarget
};
use UIAwesome\Html\Interop\Voids;

/**
 * Renders the HTML `<input type="submit">` element.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputSubmit::tag()
 *     ->class('btn btn-primary')
 *     ->value('Save')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/submit
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputSubmit extends BaseInput
{
    use CanBeAutofocus;
    use HasForm;
    use HasFormaction;
    use HasFormenctype;
    use HasFormmethod;
    use HasFormnovalidate;
    use HasFormtarget;
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
        return parent::loadDefault() + ['type' => [Type::SUBMIT]];
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
