<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

use Stringable;
use UnitEnum;

/**
 * Provides an immutable API for the HTML `action` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form#action
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasAction
{
    /**
     * Sets the `action` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->action('/submit')
     *     ->render();
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value URL that processes the form submission, or `null` to remove the
     * attribute.
     *
     * @return static New instance with the updated `action` attribute.
     */
    public function action(string|Stringable|UnitEnum|null $value): static
    {
        return $this->setAttribute('action', $value);
    }
}
