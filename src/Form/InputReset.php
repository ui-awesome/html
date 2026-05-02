<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Interop\Voids;

/**
 * Renders the HTML `<input type="reset">` element.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputReset::tag()
 *     ->value('Reset')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/reset
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputReset extends BaseInput
{
    use CanBeAutofocus;
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
     * @return array<string, mixed> Default configuration for the input element, including the default `type` attribute
     * set to `reset`.
     */
    protected function loadDefault(): array
    {
        return parent::loadDefault() + ['type' => [Type::RESET]];
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
