<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Attribute;

/**
 * Provides an immutable API for the HTML `formnovalidate` attribute.
 *
 * @mixin \UIAwesome\Html\Mixin\HasAttributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Attributes/formnovalidate
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasFormnovalidate
{
    /**
     * Sets the `formnovalidate` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\InputSubmit::tag()->formnovalidate(true)->render();
     * ```
     *
     * @param bool|null $value Whether to bypass form validation, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `formnovalidate` attribute.
     */
    public function formnovalidate(bool|null $value): static
    {
        return $this->setAttribute('formnovalidate', $value);
    }
}
