<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Table;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Table\ColgroupTest} test cases.
 */
final class ColgroupProvider
{
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
