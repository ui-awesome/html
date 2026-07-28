<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Table;

use Closure;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Table\Col;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Table\ColTest} test cases.
 */
final class ColProvider
{
    /**
     * @return array<string, array{Closure(): Col, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'span above range' => [
                static fn(): Col => Col::tag()->span(1001),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('1001', 'span', '1 <= value <= 1000'),
            ],
            'span below range' => [
                static fn(): Col => Col::tag()->span(0),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('0', 'span', '1 <= value <= 1000'),
            ],
        ];
    }

    /**
     * @return array<string, array{int|string, string}>
     */
    public static function spanValues(): array
    {
        return [
            'max int' => [
                1000,
                '<col span="1000">',
            ],
            'max string' => [
                '1000',
                '<col span="1000">',
            ],
            'min int' => [
                1,
                '<col span="1">',
            ],
            'min string' => [
                '1',
                '<col span="1">',
            ],
        ];
    }
}
