<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Table;

use Closure;
use UIAwesome\Html\Attribute\Exception\Message;
use UIAwesome\Html\Table\Td;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Table\TdTest} test cases.
 */
final class TdProvider
{
    /**
     * @return array<string, array{int|string, string}>
     */
    public static function colspanValues(): array
    {
        return [
            'max int' => [
                1000,
                <<<HTML
                <td colspan="1000">
                </td>
                HTML,
            ],
            'max string' => [
                '1000',
                <<<HTML
                <td colspan="1000">
                </td>
                HTML,
            ],
            'min int' => [
                1,
                <<<HTML
                <td colspan="1">
                </td>
                HTML,
            ],
            'min string' => [
                '1',
                <<<HTML
                <td colspan="1">
                </td>
                HTML,
            ],
        ];
    }

    /**
     * @return array<string, array{Closure(): Td, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'colspan above range' => [
                static fn(): Td => Td::tag()->colspan(1001),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('1001', 'colspan', '1 <= value <= 1000'),
            ],
            'colspan below range' => [
                static fn(): Td => Td::tag()->colspan(0),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('0', 'colspan', '1 <= value <= 1000'),
            ],
            'rowspan above range' => [
                static fn(): Td => Td::tag()->rowspan(65535),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('65535', 'rowspan', '0 <= value <= 65534'),
            ],
            'rowspan below range' => [
                static fn(): Td => Td::tag()->rowspan(-1),
                Message::ATTRIBUTE_INVALID_VALUE->getMessage('-1', 'rowspan', '0 <= value <= 65534'),
            ],
        ];
    }

    /**
     * @return array<string, array{int|string, string}>
     */
    public static function rowspanValues(): array
    {
        return [
            'max int' => [
                65534,
                <<<HTML
                <td rowspan="65534">
                </td>
                HTML,
            ],
            'max string' => [
                '65534',
                <<<HTML
                <td rowspan="65534">
                </td>
                HTML,
            ],
            'min int' => [
                0,
                <<<HTML
                <td rowspan="0">
                </td>
                HTML,
            ],
            'min string' => [
                '0',
                <<<HTML
                <td rowspan="0">
                </td>
                HTML,
            ],
        ];
    }
}
