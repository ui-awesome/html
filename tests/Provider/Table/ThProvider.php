<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Table;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Table\ThTest} test cases.
 *
 * Provides boundary and numeric-string input/output pairs for the `colspan` and `rowspan` attributes.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
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
}
