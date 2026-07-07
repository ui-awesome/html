<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Table;

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
