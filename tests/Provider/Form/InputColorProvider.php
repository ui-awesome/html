<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Form;

use Closure;
use UIAwesome\Html\Attribute\Values\GlobalAttribute;
use UIAwesome\Html\Form\InputColor;
use UIAwesome\Html\Form\Values\Colorspace;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Form\InputColorTest} test cases.
 */
final class InputColorProvider
{
    /**
     * @return array<string, array{Closure(): InputColor, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'colorspace outside list' => [
                static fn(): InputColor => InputColor::tag()->colorspace('invalid-value'),
                Message::VALUE_NOT_IN_LIST->getMessage(
                    'invalid-value',
                    'colorspace',
                    implode("', '", Enum::normalizeStringArray(Colorspace::cases())),
                ),
            ],
            'tabindex below range' => [
                static fn(): InputColor => InputColor::tag()->tabIndex(-2),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '-2',
                    GlobalAttribute::TABINDEX->value,
                    'value >= -1',
                ),
            ],
        ];
    }
}
