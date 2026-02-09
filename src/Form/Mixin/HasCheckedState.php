<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use Stringable;
use UIAwesome\Html\Helper\Enum;
use UnitEnum;

use function is_array;
use function is_bool;
use function is_scalar;

/**
 * Provides methods to configure the checked state of form elements like checkboxes and radio buttons.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait HasCheckedState
{
    /**
     * Determines the checked state of the element.
     *
     * @phpstan-var mixed[]|bool|float|int|string|Stringable|UnitEnum|null $checked
     */
    private array|bool|float|int|string|Stringable|UnitEnum|null $checked = null;

    /**
     * Sets the `checked` attribute.
     *
     * Usage example:
     * ```php
     * $element->checked(true);
     * $element->checked(false);
     * $element->checked('active')->value('active'); // checked
     * $element->checked('inactive')->value('active'); // unchecked
     * ```
     *
     * @param array|bool|float|int|string|Stringable|UnitEnum|null $value Checked state.
     *
     * - `array`: Element is checked if the value is in the array.
     * - `false`: Element is unchecked.
     * - `true`: Element is checked.
     * - `float|int|string|Stringable|UnitEnum`: Element is checked if the value matches the `value` attribute.
     * - `null`: Attribute is removed.
     *
     * @return static New instance with the updated `checked` attribute.
     *
     * @phpstan-param mixed[]|bool|float|int|string|Stringable|UnitEnum|null $value
     */
    public function checked(array|bool|float|int|string|Stringable|UnitEnum|null $value): static
    {
        $new = clone $this;
        $new->checked = $value;

        return $new;
    }

    /**
     * Builds the attributes for the `<input>` element.
     *
     * This method normalizes the `value` attribute and determines the `checked` state based on the current value and
     * the configured checked options.
     *
     * @param array $attributes Initial attributes array.
     *
     * @return array Updated attributes array with the `checked` attribute if applicable.
     *
     * @phpstan-param mixed[] $attributes
     * @phpstan-return mixed[]
     */
    private function buildAttributes(array $attributes): array
    {
        if (isset($attributes['value']) && is_bool($attributes['value'])) {
            $attributes['value'] = $attributes['value'] ? 1 : 0;
        }

        $checked = $this->checked;

        $normalizedChecked = is_array($checked)
            ? Enum::normalizeArray($checked)
            : Enum::normalizeValue($checked);

        if ($normalizedChecked === false || $normalizedChecked === null) {
            return $attributes;
        }

        $value = $attributes['value'] ?? null;

        if ($normalizedChecked === true) {
            $attributes['checked'] = true;

            return $attributes;
        }

        $valueStr = is_scalar($value) ? (string) $value : '';

        if (is_array($normalizedChecked) === false) {
            $attributes['checked'] = $valueStr === "{$normalizedChecked}";

            return $attributes;
        }

        foreach ($normalizedChecked as $item) {
            if (is_scalar($item) && "{$item}" === $valueStr) {
                $attributes['checked'] = true;
            }
        }

        return $attributes;
    }
}
