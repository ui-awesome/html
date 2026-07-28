<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Interactive;

use UIAwesome\Html\Interactive\Values\Closedby;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Interactive\DialogTest} test cases.
 */
final class DialogProvider
{
    /**
     * @return array<string, array{string|Closedby, string}>
     */
    public static function closedby(): array
    {
        return [
            'any' => [
                'any',
                'any',
            ],
            'closerequest' => [
                'closerequest',
                'closerequest',
            ],
            'none' => [
                'none',
                'none',
            ],
            'ANY' => [
                Closedby::ANY,
                'any',
            ],
            'CLOSEREQUEST' => [
                Closedby::CLOSEREQUEST,
                'closerequest',
            ],
            'NONE' => [
                Closedby::NONE,
                'none',
            ],
        ];
    }
}
