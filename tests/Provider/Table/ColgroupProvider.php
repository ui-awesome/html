<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Table;

use Closure;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Table\Colgroup;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Table\ColgroupTest} test cases.
 */
final class ColgroupProvider
{
    /**
     * @return array<string, array{Closure(): Colgroup, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'span above range' => [
                static fn(): Colgroup => Colgroup::tag()->span(1001),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('1001', 'span', '1 <= value <= 1000'),
            ],
            'span below range' => [
                static fn(): Colgroup => Colgroup::tag()->span(0),
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
                <<<HTML
                <colgroup span="1000">
                </colgroup>
                HTML,
            ],
            'max string' => [
                '1000',
                <<<HTML
                <colgroup span="1000">
                </colgroup>
                HTML,
            ],
            'min int' => [
                1,
                <<<HTML
                <colgroup span="1">
                </colgroup>
                HTML,
            ],
            'min string' => [
                '1',
                <<<HTML
                <colgroup span="1">
                </colgroup>
                HTML,
            ],
        ];
    }
}
