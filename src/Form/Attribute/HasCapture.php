<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use Stringable;
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Mixin\HasAttributes;
use UnitEnum;

/**
 * Provides an immutable API for the `capture` attribute.
 *
 * @mixin HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/capture
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasCapture
{
    /**
     * Sets the `capture` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputFile::tag()
     *     ->capture('user')
     *     ->render();
     * echo \UIAwesome\Html\Form\InputFile::tag()
     *     ->capture('environment')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value Capture value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `capture` attribute.
     */
    public function capture(string|Stringable|UnitEnum|null $value): static
    {
        return $this->setAttribute(Attribute::CAPTURE, $value);
    }
}
