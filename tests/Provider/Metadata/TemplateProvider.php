<?php

declare(strict_types=1);

namespace UIAwesome\Html\Tests\Provider\Metadata;

use UIAwesome\Html\Metadata\Values\ShadowRootMode;

/**
 * Data provider for {@see \UIAwesome\Html\Tests\Metadata\TemplateTest} test cases.
 */
final class TemplateProvider
{
    /**
     * @return array<string, array{string|ShadowRootMode, string}>
     */
    public static function shadowRootMode(): array
    {
        return [
            'closed' => [
                'closed',
                'closed',
            ],
            'open' => [
                'open',
                'open',
            ],
            'CLOSED' => [
                ShadowRootMode::CLOSED,
                'closed',
            ],
            'OPEN' => [
                ShadowRootMode::OPEN,
                'open',
            ],
        ];
    }
}
