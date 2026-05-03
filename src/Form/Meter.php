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
 * Renders the HTML `<meter>` element for scalar measurements within a known range, such as disk usage or the relevance
 * of a search result.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Form\Meter::tag()
 *     ->content('at 50/100')
 *     ->high(66)
 *     ->low(33)
 *     ->max(100)
 *     ->min(0)
 *     ->optimum(80)
 *     ->value(50)
 *     ->render();
 * ```
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/meter
 * {@see BaseInline} for the base implementation.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Meter extends BaseInline
{
    use HasValue;

    /**
     * Sets the `high` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Meter::tag()
     *     ->high(66)
     *     ->render();
     * ```
     *
     * @param float|int|string|null $value Lower numeric bound of the high end of the measured range, or `null` to
     * remove the attribute.
     *
     * @return static New instance with the updated `high` attribute.
     */
    public function high(float|int|string|null $value): static
    {
        return $this->addAttribute('high', $value);
    }

    /**
     * Sets the `low` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Meter::tag()
     *     ->low(33)
     *     ->render();
     * ```
     *
     * @param float|int|string|null $value Upper numeric bound of the low end of the measured range, or `null` to remove
     * the attribute.
     *
     * @return static New instance with the updated `low` attribute.
     */
    public function low(float|int|string|null $value): static
    {
        return $this->addAttribute('low', $value);
    }

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
     * Sets the `min` attribute.
     *
     * Usage example:
     * ```php
     * $element->min(0);
     * $element->min('2024-01-01');
     * $element->min('08:00');
     * $element->min(null);
     * ```
     *
     * @param float|int|string|Stringable|UnitEnum|null $value Minimum value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `min` attribute.
     */
    public function min(float|int|string|Stringable|UnitEnum|null $value): static
    {
        return $this->addAttribute(Attribute::MIN, $value);
    }

    /**
     * Sets the `optimum` attribute.
     *
     * Usage example:
     * ```php
     * echo \UIAwesome\Html\Form\Meter::tag()
     *     ->optimum(80)
     *     ->render();
     * ```
     *
     * @param float|int|string|null $value Optimal numeric value, or `null` to remove the attribute.
     *
     * @return static New instance with the updated `optimum` attribute.
     */
    public function optimum(float|int|string|null $value): static
    {
        return $this->addAttribute('optimum', $value);
    }

    /**
     * Returns the tag enumeration for the `<meter>` element.
     *
     * @return Inline Tag enumeration instance for `<meter>`.
     *
     * {@see Inline} for valid inline-level tags.
     */
    protected function getTag(): Inline
    {
        return Inline::METER;
    }

    /**
     * Renders the `<meter>` element with its content and attributes.
     *
     * @return string Rendered HTML for the `<meter>` element.
     */
    protected function run(): string
    {
        return $this->buildElement($this->getContent());
    }
}
