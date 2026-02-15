<?php

declare(strict_types=1);

namespace UIAwesome\Html\Phrasing;

use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\{Inline, InlineInterface};

/**
 * Renders the HTML `<label>` element.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Phrasing\Label::tag()
 *     ->content('Email Address')
 *     ->for('email')
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/label
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Label extends BaseInline
{
    /**
     * Sets the `for` attribute.
     *
     * Usage example:
     * ```php
     * $label = Label::tag()->for('username');
     * ```
     *
     * @param string|null $value ID of a labelable form-related element in the same document as the label element, or
     * `null` to remove the attribute.
     *
     * @return static New instance with the updated `for` attribute.
     */
    public function for(string|null $value = null): static
    {
        return $this->setAttribute('for', $value);
    }

    /**
     * Returns the tag enumeration for the `<label>` element.
     *
     * @return InlineInterface Tag enumeration instance for `<label>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): InlineInterface
    {
        return Inline::LABEL;
    }

    /**
     * Renders the `<label>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<label>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
