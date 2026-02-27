<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Form\CanBeRequired;
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Form\Mixin\HasCheckedState;
use UIAwesome\Html\Interop\Voids;

/**
 * Represents the HTML `<input type="checkbox">` element.
 *
 * The checkbox is a graphical control element that allows the user to select or deselect one or more independent
 * options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputCheckbox::tag()
 *     ->checked(true)
 *     ->name('terms')
 *     ->value('accepted')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/checkbox
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputCheckbox extends BaseInput
{
    use CanBeAutofocus;
    use CanBeRequired;
    use HasCheckedState;
    use HasTabindex;
    use HasValue;

    /**
     * Returns the array of HTML attributes for the element.
     *
     * @return array Attributes array assigned to the element.
     *
     * @phpstan-return mixed[]
     */
    public function getAttributes(): array
    {
        return $this->buildAttributes(parent::getAttributes());
    }

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
        return parent::loadDefault() + ['type' => [Type::CHECKBOX]];
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
