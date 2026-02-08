<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Form\Base\BaseInputChoice;
use UIAwesome\Html\Interop\{VoidInterface, Voids};

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
final class InputCheckbox extends BaseInputChoice
{
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
        return ['type' => [Type::CHECKBOX]] + parent::loadDefault();
    }
}
