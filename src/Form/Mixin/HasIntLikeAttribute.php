<?php

declare(strict_types=1);

namespace UIAwesome\Html\Form\Mixin;

use InvalidArgumentException;
use Stringable;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Helper\{Enum, Validator};
use UnitEnum;

/**
 * Provides shared validation for attributes restricted to integer-like values.
 */
trait HasIntLikeAttribute
{
    /**
     * Validates an integer-like attribute value.
     *
     * @param int|string|Stringable|UnitEnum|null $value Attribute value.
     * @param string|UnitEnum $attribute Attribute name.
     * @param int|null $min Minimum allowed value.
     * @param int|null $max Maximum allowed value.
     * @param string $expected Expected value description.
     *
     * @throws InvalidArgumentException if the value is outside the expected integer-like range.
     *
     * @return int|string|Stringable|null Normalized attribute value.
     */
    private static function intLikeAttribute(
        int|string|Stringable|UnitEnum|null $value,
        string|UnitEnum $attribute,
        int|null $min = null,
        int|null $max = null,
        string $expected = 'value >= 0',
    ): int|string|Stringable|null {
        if ($value instanceof UnitEnum) {
            $value = Enum::normalizeValue($value);
        }

        if ($value !== null && Validator::intLike($value, $min, $max) === false) {
            throw new InvalidArgumentException(
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    (string) $value,
                    (string) Enum::normalizeValue($attribute),
                    $expected,
                ),
            );
        }

        return $value;
    }
}
