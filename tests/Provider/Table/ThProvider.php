<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Table;

use Closure;
use UIAwesome\Html\Helper\Enum;
use UIAwesome\Html\Helper\Exception\Message;
use UIAwesome\Html\Table\Th;
use UIAwesome\Html\Table\Values\Scope;

use function implode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Table\ThTest} test cases.
 */
final class ThProvider
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
                <th colspan="1000">
                </th>
                HTML,
            ],
            'max string' => [
                '1000',
                <<<HTML
                <th colspan="1000">
                </th>
                HTML,
            ],
            'min int' => [
                1,
                <<<HTML
                <th colspan="1">
                </th>
                HTML,
            ],
            'min string' => [
                '1',
                <<<HTML
                <th colspan="1">
                </th>
                HTML,
            ],
        ];
    }

    /**
     * @return array<string, array{Closure(): Th, string}>
     */
    public static function invalidAttributeValues(): array
    {
        return [
            'colspan above range' => [
                static fn(): Th => Th::tag()->colspan(1001),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '1001',
                    'colspan',
                    '1 <= value <= 1000',
                ),
            ],
            'colspan below range' => [
                static fn(): Th => Th::tag()->colspan(0),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '0',
                    'colspan',
                    '1 <= value <= 1000',
                ),
            ],
            'rowspan above range' => [
                static fn(): Th => Th::tag()->rowspan(65535),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '65535',
                    'rowspan',
                    '0 <= value <= 65534',
                ),
            ],
            'rowspan below range' => [
                static fn(): Th => Th::tag()->rowspan(-1),
                \UIAwesome\Html\Attribute\Exception\Message::ATTRIBUTE_INVALID_VALUE->getMessage(
                    '-1',
                    'rowspan',
                    '0 <= value <= 65534',
                ),
            ],
            'scope outside list' => [
                static fn(): Th => Th::tag()->scope('invalid-value'),
                Message::VALUE_NOT_IN_LIST->getMessage(
                    'invalid-value',
                    'scope',
                    implode("', '", Enum::normalizeStringArray(Scope::cases())),
                ),
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
                <th rowspan="65534">
                </th>
                HTML,
            ],
            'max string' => [
                '65534',
                <<<HTML
                <th rowspan="65534">
                </th>
                HTML,
            ],
            'min int' => [
                0,
                <<<HTML
                <th rowspan="0">
                </th>
                HTML,
            ],
            'min string' => [
                '0',
                <<<HTML
                <th rowspan="0">
                </th>
                HTML,
            ],
        ];
    }

    /**
     * @return array<string, array{string|Scope, string}>
     */
    public static function scope(): array
    {
        return [
            'col' => [
                'col',
                <<<HTML
                <th scope="col">
                </th>
                HTML,
            ],
            'colgroup' => [
                'colgroup',
                <<<HTML
                <th scope="colgroup">
                </th>
                HTML,
            ],
            'row' => [
                'row',
                <<<HTML
                <th scope="row">
                </th>
                HTML,
            ],
            'rowgroup' => [
                'rowgroup',
                <<<HTML
                <th scope="rowgroup">
                </th>
                HTML,
            ],
            'COL' => [
                Scope::COL,
                <<<HTML
                <th scope="col">
                </th>
                HTML,
            ],
            'COLGROUP' => [
                Scope::COLGROUP,
                <<<HTML
                <th scope="colgroup">
                </th>
                HTML,
            ],
            'ROW' => [
                Scope::ROW,
                <<<HTML
                <th scope="row">
                </th>
                HTML,
            ],
            'ROWGROUP' => [
                Scope::ROWGROUP,
                <<<HTML
                <th scope="rowgroup">
                </th>
                HTML,
            ],
        ];
    }
}
