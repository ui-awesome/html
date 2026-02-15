<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Html;
use UIAwesome\Html\Form\Base\BaseChoice;
use UIAwesome\Html\Interop\{VoidInterface, Voids};

/**
 * Represents the HTML `<input type="radio">` element.
 *
 * The radio button is a graphical control element that allows the user to choose only one of a predefined set of mutually
 * exclusive options.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputRadio::tag()
 *     ->checked(true)
 *     ->name('gender')
 *     ->value('female')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/radio
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputRadio extends BaseChoice
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
        return [
            'template' => ['{prefix}\n{unchecked}\n{tag}\n{label}\n{suffix}'],
            'type' => [Type::RADIO],
        ] + parent::loadDefault();
    }
}
