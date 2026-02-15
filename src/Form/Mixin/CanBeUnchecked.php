<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use Stringable;
use UnitEnum;

/**
 * Provides methods to configure whether the element can be unchecked.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
trait CanBeUnchecked
{
    /**
     * Value to be submitted when the element is not checked.
     *
     * If set, an additional hidden input will be rendered with the same name as the element and this value.
     *
     * This ensures that a value is always submitted for the element, even when it is unchecked.
     */
    private bool|float|int|string|Stringable|UnitEnum|null $uncheckedValue = null;

    /**
     * Set the value that should be submitted when the element is not checked.
     *
     * @param bool|float|int|string|Stringable|UnitEnum|null $value Value to be submitted.
     *
     * @return static New instance with the updated `uncheckedValue` value.
     */
    public function uncheckedValue(bool|float|int|string|Stringable|UnitEnum|null $value): static
    {
        $new = clone $this;
        $new->uncheckedValue = $value;

        return $new;
    }

    /**
     * Get the value that should be submitted when the element is not checked.
     *
     * @return bool|float|int|string|Stringable|UnitEnum|null Value to be submitted.
     */
    private function getUncheckedValue(): bool|float|int|string|Stringable|UnitEnum|null
    {
        return $this->uncheckedValue;
    }
}
