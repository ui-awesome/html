<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

/**
 * Provides an immutable API for the HTML `novalidate` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form#novalidate
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait CanBeNovalidate
{
    /**
     * Sets the `novalidate` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Form::tag()
     *     ->novalidate(true)
     *     ->render();
     * ```
     *
     * @param bool|null $value Whether to bypass form validation on submission, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `novalidate` attribute.
     */
    public function novalidate(bool|null $value): static
    {
        return $this->setAttribute('novalidate', $value);
    }
}
