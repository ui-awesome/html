<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Metadata;

use PHPForge\Support\Stub\BackedString;
use UIAwesome\Html\Attribute\Values\Blocking;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Metadata\StyleTest} test cases.
 */
final class StyleProvider
{
    /**
     * @return array<string, array{Blocking|string, string}>
     */
    public static function blocking(): array
    {
        return [
            'render' => [
                'render',
                'render',
            ],
            'RENDER' => [
                Blocking::RENDER,
                'render',
            ],
        ];
    }

    /**
     * @return array<string, array{BackedString|string, string}>
     */
    public static function type(): array
    {
        return [
            'text/css' => [
                'text/css',
                'text/css',
            ],
            'obsolete MIME type is not rejected' => [
                'text/plain',
                'text/plain',
            ],
            'unrecognized value passes through' => [
                'not-a-mime-type',
                'not-a-mime-type',
            ],
            'enum' => [
                BackedString::VALUE,
                'value',
            ],
        ];
    }
}
