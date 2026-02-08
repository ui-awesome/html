<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use Stringable;
use UIAwesome\Html\Helper\CSSClass;
use UnitEnum;

/**
 * Provides methods to configure the label for the input element.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/label
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasLabel
{
    /**
     * Label content.
     */
    protected string $label = '';

    /**
     * Label attributes.
     *
     * @phpstan-var mixed[] $labelAttributes
     */
    protected array $labelAttributes = [];

    /**
     * Whether to render the label.
     */
    protected bool $notLabel = false;

    /**
     * Sets the label content.
     *
     * Usage example:
     * ```php
     * $element->label('My Label');
     * ```
     *
     * @param string $content The label content.
     *
     * @return static New instance with the updated `label` value.
     */
    public function label(string $content): static
    {
        $new = clone $this;
        $new->label = $content;

        return $new;
    }

    /**
     * Sets the label attributes.
     *
     * Usage example:
     * ```php
     * $element->labelAttributes(['class' => 'form-label']);
     * ```
     *
     * @param array $attributes The label attributes.
     *
     * @return static New instance with the updated `labelAttributes` value.
     *
     * @phpstan-param mixed[] $attributes
     */
    public function labelAttributes(array $attributes): static
    {
        $new = clone $this;
        $new->labelAttributes = $attributes;

        return $new;
    }

    /**
     * Sets the `class` attribute of the label.
     *
     * Usage example:
     * ```php
     * $element->labelClass('my-class');
     * $element->labelClass(Theme::PRIMARY);
     * $element->labelClass(
     *     new class implements Stringable {
     *         public function __toString(): string
     *         {
     *            return 'stringable-class';
     *         }
     *     },
     * );
     * $element->labelClass('another-class', true);
     * $element->labelClass(null);
     * ```
     *
     * @param string|Stringable|UnitEnum|null $value CSS class value, or `null` to remove the attribute.
     * @param bool $override Whether to override existing classes (`true`) or merge (`false`).
     *
     * @return static New instance with the updated `labelAttributes['class']` value.
     */
    public function labelClass(string|Stringable|UnitEnum|null $value, bool $override = false): static
    {
        $new = clone $this;

        if ($value === null) {
            unset($new->labelAttributes['class']);
        } else {
            CSSClass::add($new->labelAttributes, $value, $override);
        }

        return $new;
    }

    /**
     * Sets the `for` attribute of the label.
     *
     * Usage example:
     * ```php
     * $element->labelFor('input-id');
     * $element->labelFor(null);
     * ```
     *
     * @param string|null $value The value of the `for` attribute.
     *
     * @return static New instance with the updated `labelAttributes['for']` value.
     */
    public function labelFor(string|null $value): static
    {
        $new = clone $this;
        $new->labelAttributes['for'] = $value;

        return $new;
    }

    /**
     * Disables the label rendering.
     *
     * Usage example:
     * ```php
     * $element->notLabel();
     * ```
     *
     * @return static New instance with the updated `notLabel` value.
     */
    public function notLabel(): static
    {
        $new = clone $this;
        $new->notLabel = true;

        return $new;
    }
}
