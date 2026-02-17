<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use UIAwesome\Html\Attribute\Element\{HasAlt, HasHeight, HasSrc, HasWidth};
use UIAwesome\Html\Attribute\Global\{CanBeAutofocus, HasTabindex};
use UIAwesome\Html\Attribute\Values\Type;
use UIAwesome\Html\Core\Element\BaseInput;
use UIAwesome\Html\Form\Attribute\{
    HasFormaction,
    HasFormenctype,
    HasFormmethod,
    HasFormnovalidate,
    HasFormtarget
};
use UIAwesome\Html\Interop\{VoidInterface, Voids};

/**
 * Renders the HTML `<input type="image">` element.
 *
 * The `<input type="image">` element is used to create graphical submit buttons, i.e., submit buttons that take the form
 * of an image rather than text.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\InputImage::tag()
 *     ->alt('Login')
 *     ->height(30)
 *     ->src('/images/login.png')
 *     ->width(100)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/image
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class InputImage extends BaseInput
{
    use CanBeAutofocus;
    use HasAlt;
    use HasFormaction;
    use HasFormenctype;
    use HasFormmethod;
    use HasFormnovalidate;
    use HasFormtarget;
    use HasHeight;
    use HasSrc;
    use HasTabindex;
    use HasWidth;

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
        return parent::loadDefault() + ['type' => [Type::IMAGE]];
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
