<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form;

use Stringable;
use UIAwesome\Html\Attribute\HasValue;
use UIAwesome\Html\Attribute\Values\Attribute;
use UIAwesome\Html\Core\Element\BaseInline;
use UIAwesome\Html\Interop\Inline;
use UnitEnum;

/**
 * Renders the HTML `<progress>` element as a progress indicator.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Progress::tag()
 *     ->content('70%')
 *     ->max(100)
 *     ->value(70)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/progress
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Progress extends BaseInline
{
    use HasValue;

    /**
     * Sets the `max` attribute.
     *
     * Usage example:
     * ```php
     * $element->max(100);
     * $element->max('2024-12-31');
     * $element->max('23:59');
     * $element->max(null);
     * ```
     *
     * @param float|int|string|Stringable|UnitEnum|null $value Maximum value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `max` attribute.
     */
    public function max(float|int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::MAX, $value);
    }

    /**
     * Returns the tag enumeration for the `<progress>` element.
     *
     * @return Inline Tag enumeration instance for `<progress>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::PROGRESS;
    }

    /**
     * Renders the `<progress>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<progress>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
