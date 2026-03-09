<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Table;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Table\ColTest} test cases.
 *
 * Provides boundary and numeric-string input/output pairs for the `span` attribute.
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class ColProvider
{
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
