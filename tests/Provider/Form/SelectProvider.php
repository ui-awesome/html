<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use Closure;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Attribute\Values\{Attribute, ElementAttribute};
use UIAwesome\Html\Form\Select;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\SelectTest} test cases.
 */
final class SelectProvider
{
    /**
     * @return array<string, array{Closure(): string, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'multiple selection with a scalar value' => [
                static fn(): string => Select::tag()->multiple(true)->value('dog')->render(),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    'dog',
                    ElementAttribute::VALUE->value,
                    'array when "multiple" is true',
                ),
            ],
            'single selection with several values' => [
                static fn(): string => Select::tag()->value(['dog', 'cat'])->render(),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    'dog, cat',
                    ElementAttribute::VALUE->value,
                    'single value unless "multiple" is true',
                ),
            ],
            'size outside range' => [
                static fn(): string => Select::tag()->size('invalid-value')->render(),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    'invalid-value',
                    Attribute::SIZE->value,
                    'value >= 0',
                ),
            ],
        ];
    }
}
